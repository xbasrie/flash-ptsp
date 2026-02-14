<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use App\Models\ActivityLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ActivityLogResource extends Resource
{
    use \App\Filament\Traits\HasPermissionAccess;

    protected static ?string $model = ActivityLog::class;

    protected static ?string $navigationGroup = 'User Management';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Log Aktivitas Admin';
    protected static ?int $navigationSort = 9002;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('action')
                    ->label('Aksi')
                    ->disabled(),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->disabled(),
                Forms\Components\TextInput::make('subject_type')
                    ->label('Tipe Subject')
                    ->disabled(),
                Forms\Components\TextInput::make('subject_id')
                    ->label('ID Subject')
                    ->disabled(),
                Forms\Components\TextInput::make('ip_address')
                    ->label('IP Address')
                    ->disabled(),
                Forms\Components\TextInput::make('user_agent')
                    ->label('User Agent')
                    ->disabled(),
                Forms\Components\DatePicker::make('created_at')
                    ->label('Tanggal')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y H:i:s')
                    ->timezone('Asia/Jakarta')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),
                Tables\Columns\TextColumn::make('action')
                    ->label('Aksi')
                    ->badge()
                    ->colors([
                        'success' => fn ($state) => in_array($state, ['created', 'login']),
                        'warning' => fn ($state) => in_array($state, ['updated', 'logout']),
                        'danger' => fn ($state) => $state === 'deleted',
                    ]),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // Read only
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivityLogs::route('/'),
        ];
    }


    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }
    
    public static function canDelete($record): bool
    {
        return false;
    }
}
