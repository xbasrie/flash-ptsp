<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZawaTanahSubmissionResource\Pages;
use App\Models\Submission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use App\Models\TrackingLog;
use Filament\Forms\Components\FileUpload;

class ZawaTanahSubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Pendampingan Wakaf';
    protected static ?string $pluralLabel = 'Pendampingan Wakaf';
    protected static ?string $slug = 'zawa-tanah-submissions';
    protected static ?string $navigationGroup = 'Layanan Zakat & Wakaf';
    protected static ?int $navigationSort = 801;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('service', function ($query) {
            $query->where('slug', 'zawa-tanah');
        });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pemohon')
                    ->schema([
                        Forms\Components\TextInput::make('content.nama')
                            ->label('Nama Pemohon')
                            ->required(),
                        Forms\Components\TextInput::make('content.no_hp')
                            ->label('No. Handphone')
                            ->tel()
                            ->required(),
                        Forms\Components\TextInput::make('content.email')
                            ->label('Email')
                            ->email(),
                    ])->columns(3),
                
                Forms\Components\Section::make('Persyaratan Dokumen')
                    ->schema([
                        FileUpload::make('content.files.ktp_wakif')
                            ->label('KTP Wakif')
                            ->disk('public')
                            ->required()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.ktp_nadzir')
                            ->label('KTP Nadzir')
                            ->disk('public')
                            ->required()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.surat_tanah')
                            ->label('Surat-Surat Tanah')
                            ->disk('public')
                            ->required()
                            ->downloadable()
                            ->openable(),
                        Forms\Components\Toggle::make('content.has_certificate')
                            ->label('Tanah Sudah Bersertifikat?')
                            ->reactive()
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('Dokumen Tambahan (Belum Bersertifikat)')
                    ->schema([
                        FileUpload::make('content.files.riwayat_tanah')
                            ->label('Riwayat Tanah dari Kelurahan')
                            ->disk('public')
                            ->required()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.pernyataan_fisik')
                            ->label('Surat Pernyataan Penguasaan Fisik')
                            ->disk('public')
                            ->required()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.surat_tidak_sengketa')
                            ->label('Surat Pernyataan Tidak Sengketa')
                            ->disk('public')
                            ->required()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.tanggung_jawab_mutlak')
                            ->label('Surat Tanggung Jawab Mutlak')
                            ->disk('public')
                            ->required()
                            ->downloadable()
                            ->openable(),
                    ])
                    ->visible(fn (Forms\Get $get) => !$get('content.has_certificate'))
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->timezone('Asia/Jakarta')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tracking_code')
                    ->label('Kode Tracking')
                    ->searchable(),
                Tables\Columns\TextColumn::make('content.nama')
                    ->label('Nama Pemohon')
                    ->searchable(),
                 Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'process', 'proses' => 'info',
                        'approved', 'selesai' => 'success',
                        'rejected', 'ditolak' => 'danger',
                        default => 'gray',
                    }),
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
                Action::make('updateStatus')
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
                        Forms\Components\Textarea::make('note')
                            ->label('Catatan')
                            ->rows(3),
                    ])
                    ->action(function (Submission $record, array $data) {
                        $record->update([
                            'status' => $data['status'],
                            'admin_note' => $data['note'] ?? null,
                        ]);
                        
                        TrackingLog::create([
                            'submission_id' => $record->id,
                            'status' => $data['status'],
                            'note' => $data['note'] ?? 'Status diperbarui oleh admin',
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
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListZawaTanahSubmissions::route('/'),
            'create' => Pages\CreateZawaTanahSubmission::route('/create'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->where('status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(['super admin', 'admin zawa']);
    }

    public static function canCreate(): bool
    {
        return true;
    }
}
