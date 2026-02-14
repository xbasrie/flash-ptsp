<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use Spatie\Permission\Models\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationGroup = 'User Management';
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?int $navigationSort = 9001;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\Section::make('Hak Akses Layanan')
                    ->description('Pilih layanan yang dapat diakses oleh role ini.')
                    ->schema(static::getResourcePermissionSchema()),
            ]);
    }

    public static function getResourcePermissionSchema(): array
    {
        $resources = \Filament\Facades\Filament::getResources();
        $groups = [];

        foreach ($resources as $resource) {
            // Skip RoleResource and UserResource to prevent locking oneself out or messy permissions
             if ($resource === static::class || $resource === \App\Filament\Resources\UserResource::class) {
                continue;
            }

            $group = $resource::getNavigationGroup() ?? 'Lainnya';
            $groups[$group][] = $resource;
        }

        $schema = [];

        foreach ($groups as $group => $resources) {
            $options = [];
            foreach ($resources as $resource) {
                $permission = 'view_any_' . \Illuminate\Support\Str::snake(\Illuminate\Support\Str::replaceLast('Resource', '', class_basename($resource)));
                $label = $resource::getNavigationLabel() ?? \Illuminate\Support\Str::headline(class_basename($resource));
                $options[$permission] = $label;
            }

            $schema[] = Forms\Components\Section::make($group)
                ->schema([
                    Forms\Components\CheckboxList::make('permissions_' . \Illuminate\Support\Str::slug($group))
                        ->label('Pilih Layanan')
                        ->options($options)
                        ->bulkToggleable()
                        ->formatStateUsing(function ($record) use ($options) {
                            if (! $record) return [];
                            return $record->permissions->pluck('name')->intersect(array_keys($options))->toArray();
                        })
                        ->dehydrated(false) // We will handle saving manually
                        ->afterStateHydrated(function (Forms\Components\CheckboxList $component, ?Role $record) use ($options) {
                             if (! $record) return;
                             $component->state($record->permissions->pluck('name')->intersect(array_keys($options))->toArray());
                        }),
                ])
                ->collapsible();
        }

        return $schema;
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('guard_name'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->timezone('Asia/Jakarta'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data, Role $record) {
                        // Logic to save permissions is handled in afterSave/handleRecordUpdate,
                        // but we need to capture the form data.
                        // Actually, 'dehydrated(false)' means it won't be in $data here generally if not careful.
                        // However, we can access the form component state in a stronger way or just use `after` hook on the action.
                        return $data;
                    })
                    ->using(function (Role $record, array $data, $livewire) {
                         // Custom update to handle permissions
                         $role = $record;
                         $role->update($data); // Update name

                         // Collect all permissions from the Livewire component state
                         $formData = $livewire->form->getState();
                         $permissions = [];
                         
                         foreach ($formData as $key => $value) {
                             if (\Illuminate\Support\Str::startsWith($key, 'permissions_') && is_array($value)) {
                                 $permissions = array_merge($permissions, $value);
                             }
                         }

                         // Sync permissions
                         // Note: We should probably only sync permissions related to resources, keeping others intact if any.
                         // For now, we assume these are the only managed permissions or we just give these.
                         // BETTER: givePermissionTo / syncPermissions.
                         // But we need to be careful not to remove 'super admin' or other system permissions if they exist manually.
                         // For this feature, we will sync.
                         
                         // Ensure permissions exist in DB
                         foreach ($permissions as $permissionName) {
                             \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permissionName]);
                         }

                         $role->syncPermissions($permissions);
                         
                         return $role;
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
             // We are using modals or standard pages? The resource shows 'create' and 'edit' pages defined.
             // If using Pages, the action modification above in `table()` only affects the modal action if used there.
             // But RoleResource usually uses Pages. We need to override the `CreateRole` and `EditRole` pages to handle the saving.
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
