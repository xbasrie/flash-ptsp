<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsulDataSiasnSubmissionResource\Pages;
use App\Models\Submission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UsulDataSiasnSubmissionResource extends Resource
{
    use \App\Filament\Traits\HasPermissionAccess;

    protected static ?string $model = Submission::class;

    protected static ?string $navigationGroup = 'Layanan Kepegawaian';
    protected static ?string $navigationLabel = 'Usul Ralat Data SIASN';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->where('status', 'pending')->count() ?: null;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('service', fn($q) => $q->where('slug', 'usul-ralat-data-siasn'));
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
                        Forms\Components\TextInput::make('content.pangkat_golongan')->label('Pangkat/Golongan')->required()->disabled(),
                        Forms\Components\TextInput::make('content.no_hp')->label('No. HP (WhatsApp)')->required()->disabled(),
                        Forms\Components\TextInput::make('content.email')->label('Email')->required()->disabled(),
                    ])->columns(2),
                Forms\Components\Section::make('Berkas Persyaratan')
                    ->schema([
                        Forms\Components\FileUpload::make('content.surat_pengantar')
                            ->label('Surat Pengantar')
                            ->disk('public')
                            ->downloadable()
                            ->openable()
                            ->disabled(),
                        Forms\Components\FileUpload::make('content.sptjm')
                            ->label('SPTJM')
                            ->disk('public')
                            ->downloadable()
                            ->openable()
                            ->disabled(),
                        Forms\Components\FileUpload::make('content.surat_persetujuan')
                            ->label('Surat Persetujuan')
                            ->disk('public')
                            ->downloadable()
                            ->openable()
                            ->disabled(),
                        Forms\Components\FileUpload::make('content.data_pendukung')
                            ->label('Data Pendukung Lainnya')
                            ->disk('public')
                            ->downloadable()
                            ->openable()
                            ->disabled(),
                    ])->columns(2),
                Forms\Components\Section::make('Status & Disposisi')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Menunggu',
                                'process' => 'Proses',
                                'approved' => 'Selesai',
                                'rejected' => 'Ditolak',
                            ])->required(),
                        Forms\Components\Textarea::make('admin_note')->label('Catatan Admin'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('tracking_code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('content.nama')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('content.nip')->label('NIP')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->timezone('Asia/Jakarta')->label('Tanggal Masuk')->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'process',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Menunggu',
                        'process' => 'Proses',
                        'approved' => 'Selesai',
                        'rejected' => 'Ditolak',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('updateStatus')
                    ->label('Ubah Status')
                    ->icon('heroicon-o-pencil-square')
                    ->color('warning')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Menunggu',
                                'process' => 'Proses',
                                'approved' => 'Selesai',
                                'rejected' => 'Ditolak',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('admin_note')
                            ->label('Catatan Admin')
                            ->required(),
                        Forms\Components\FileUpload::make('attachment')
                            ->label('Lampiran')
                            ->disk('public')
                            ->directory('attachments')
                            ->downloadable()
                            ->openable(),
                    ])
                    ->action(function (Submission $record, array $data): void {
                        $record->update([
                            'status' => $data['status'],
                            'admin_note' => $data['admin_note'],
                            'attachment' => $data['attachment'] ?? null,
                        ]);

                        \App\Models\TrackingLog::create([
                            'submission_id' => $record->id,
                            'status' => $data['status'],
                            'note' => $data['admin_note'],
                            'attachment' => $data['attachment'] ?? null,
                        ]);

                        \App\Services\ActivityLogger::log(
                            'updated',
                            'Memperbarui status permohonan ke ' . $data['status'] . ': ' . $record->tracking_code,
                            $record
                        );

                        \Filament\Notifications\Notification::make()
                            ->title('Status berhasil diperbarui')
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
            'index' => Pages\ListUsulDataSiasnSubmissions::route('/'),
        ];
    }
}
