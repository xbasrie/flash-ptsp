<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KubPendirianSubmissionResource\Pages;
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

class KubPendirianSubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Izin Pendirian Rumah Ibadah';
    protected static ?string $pluralLabel = 'Izin Pendirian Rumah Ibadah';
    protected static ?string $slug = 'kub-pendirian-submissions';
    protected static ?string $navigationGroup = 'Layanan KUB';
    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('service', function ($query) {
            $query->where('slug', 'kub-pendirian');
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
                            ->disabled(),
                        Forms\Components\TextInput::make('content.no_hp')
                            ->label('No. Handphone')
                            ->disabled(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Berkas Persyaratan')
                    ->schema([
                        FileUpload::make('content.files.surat_permohonan')
                            ->label('Surat Permohonan')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.proposal_pendirian')
                            ->label('Proposal Pendirian')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.bukti_kepemilikan_tanah')
                            ->label('Bukti Kepemilikan Tanah')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.akte_notaris_pendirian')
                            ->label('Akte Pendirian Notaris')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.rekomendasi_fkub')
                            ->label('Rekomendasi FKUB')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.susunan_pengurus')
                            ->label('Susunan Pengurus')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.surat_pernyataan_konflik')
                            ->label('Surat Pernyataan Tidak Konflik')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.surat_keterangan_domisili')
                            ->label('Surat Keterangan Domisili')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.ktp_pengguna')
                            ->label('KTP Pengguna (ZIP)')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.dukungan_masyarakat')
                            ->label('TTD Dukungan Masyarakat')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.foto_fisik_papan_nama')
                            ->label('Foto Fisik & Papan Nama')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                    ])->columns(2),
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
                        Forms\Components\FileUpload::make('attachment')
                            ->label('Lampiran')
                            ->disk('public')
                            ->directory('attachments')
                            ->downloadable()
                            ->openable(),
                    ])
                    ->action(function (Submission $record, array $data) {
                        $record->update([
                            'status' => $data['status'],
                            'admin_note' => $data['note'] ?? null,
                            'attachment' => $data['attachment'] ?? null,
                        ]);
                        
                        TrackingLog::create([
                            'submission_id' => $record->id,
                            'status' => $data['status'],
                            'note' => $data['note'] ?? 'Status diperbarui oleh admin',
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
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListKubPendirianSubmissions::route('/'),
            // 'create' => Pages\CreateKubPendirianSubmission::route('/create'),
            // 'edit' => Pages\EditKubPendirianSubmission::route('/{record}/edit'),
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
        return auth()->user()->hasRole(['super admin', 'admin kub']);
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
