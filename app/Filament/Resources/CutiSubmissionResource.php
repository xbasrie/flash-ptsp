<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CutiSubmissionResource\Pages;
use App\Models\Submission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CutiSubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationGroup = 'Layanan Kepegawaian';
    protected static ?string $navigationLabel = 'Permohonan Cuti';

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->where('status', 'pending')->count() ?: null;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('service', fn($q) => $q->where('slug', 'cuti'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas Pemohon')
                    ->schema([
                        Forms\Components\TextInput::make('content.nama')->label('Nama Lengkap')->required()->disabled(),
                        Forms\Components\TextInput::make('content.nip')->label('NIP')->required()->disabled(),
                        Forms\Components\TextInput::make('content.unit_kerja')->label('Unit Kerja')->required()->disabled(),
                        Forms\Components\TextInput::make('content.jabatan')->label('Jabatan')->required()->disabled(),
                    ])->columns(2),
                Forms\Components\Section::make('Detail Cuti')
                    ->schema([
                        Forms\Components\TextInput::make('content.jenis_cuti')->label('Jenis Cuti')->required()->disabled(),
                        Forms\Components\TextInput::make('content.lama_hari')->label('Lama (Hari)')->numeric()->disabled(),
                        Forms\Components\DatePicker::make('content.mulai_tanggal')->label('Mulai')->disabled(),
                        Forms\Components\DatePicker::make('content.sampai_tanggal')->label('Sampai')->disabled(),
                        Forms\Components\Textarea::make('content.alasan_cuti')->label('Alasan')->columnSpanFull()->disabled(),
                         Forms\Components\FileUpload::make('content.lampiran_path')
                            ->label('Lampiran')
                            ->disk('public')
                            ->downloadable()
                            ->openable()
                            ->disabled(),
                    ])->columns(2),
                Forms\Components\Section::make('Status & Disposisi')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])->required(),
                        Forms\Components\Textarea::make('admin_note')->label('Catatan Admin'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tracking_code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('content.nama')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('content.jenis_cuti')->label('Jenis Cuti'),
                 Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Tanggal Masuk')->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'proses',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'proses' => 'Proses',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('updateStatus')
                    ->label('Update Status')
                    ->icon('heroicon-o-pencil-square')
                    ->color('warning')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'proses' => 'Proses',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('admin_note')
                            ->label('Catatan Admin')
                            ->required(),
                    ])
                    ->action(function (Submission $record, array $data): void {
                        $record->update([
                            'status' => $data['status'],
                            'admin_note' => $data['admin_note'],
                        ]);

                        \App\Models\TrackingLog::create([
                            'submission_id' => $record->id,
                            'status' => $data['status'],
                            'note' => $data['admin_note'],
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Status updated successfully')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCutiSubmissions::route('/'),
            // 'create' => Pages\CreateCutiSubmission::route('/create'),
            'edit' => Pages\EditCutiSubmission::route('/{record}/edit'),
        ];
    }
}
