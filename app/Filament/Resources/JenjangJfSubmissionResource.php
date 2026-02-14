<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenjangJfSubmissionResource\Pages;
use App\Models\Submission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JenjangJfSubmissionResource extends Resource
{
    use \App\Filament\Traits\HasPermissionAccess;

    protected static ?string $model = Submission::class;

    protected static ?string $navigationGroup = 'Layanan Kepegawaian';
    protected static ?string $navigationLabel = 'Jenjang JF';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $slug = 'jenjang-jf-submissions';

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->where('status', 'pending')->count() ?: null;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('service', fn($q) => $q->where('slug', 'jenjang-jf'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas Pemohon')
                    ->schema([
                        Forms\Components\TextInput::make('content.nama')->label('Nama Lengkap')->disabled(),
                        Forms\Components\TextInput::make('content.nip')->label('NIP')->disabled(),
                        Forms\Components\TextInput::make('content.no_hp')->label('No HP')->disabled(),
                        Forms\Components\TextInput::make('content.unit_kerja')->label('Unit Kerja')->disabled(),
                        Forms\Components\TextInput::make('content.jabatan_saat_ini')->label('Jabatan Saat Ini')->disabled(),
                        Forms\Components\TextInput::make('content.golongan')->label('Golongan')->disabled(),
                        Forms\Components\TextInput::make('content.jenis_layanan')->label('Jenis Layanan')->disabled(),
                        Forms\Components\TextInput::make('content.jabatan_tujuan')->label('Jabatan Tujuan')->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Berkas Persyaratan')
                    ->schema([
                        // Common
                        Forms\Components\FileUpload::make('content.files.surat_din_usulan')->label('Surat Dinas Usulan')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.surat_persetujuan')->label('Surat Persetujuan')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sptjm')->label('SPTJM')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.hasil_evaluasi_kinerja')->label('Hasil Evaluasi Kinerja')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.surat_pernyataan_tidak_hukuman')->label('Pernyataan Tidak Hukuman')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.surat_pernyataan_tidak_pidana')->label('Pernyataan Tidak Pidana')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.surat_pernyataan_tidak_tugas_belajar')->label('Pernyataan Tidak Tugas Belajar')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sk_kp_terakhir')->label('SK KP Terakhir')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sk_jabatan_terakhir')->label('SK Jabatan Terakhir')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.skp_2_tahun')->label('SKP 2 Tahun')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sertifikat_uji_kompetensi')->label('Sertifikat Uji Kompetensi')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.anjab_abk')->label('Anjab ABK')->disk('public')->downloadable()->openable()->disabled(),
                        
                        // Kenaikan Jenjang Specific
                        Forms\Components\FileUpload::make('content.files.pak_konvensional')->label('PAK Konvensional')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_layanan') === 'kenaikan_jenjang'),
                        Forms\Components\FileUpload::make('content.files.pak_konversi')->label('PAK Konversi')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_layanan') === 'kenaikan_jenjang'),

                        // Pengangkatan Pertama Specific
                         Forms\Components\FileUpload::make('content.files.surat_keterangan_sehat')->label('Surat Keterangan Sehat')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_layanan') === 'pengangkatan_pertama'),
                          Forms\Components\FileUpload::make('content.files.surat_keterangan_integritas')->label('Surat Keterangan Integritas')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_layanan') === 'pengangkatan_pertama'),
                           Forms\Components\FileUpload::make('content.files.ijazah_transkrip')->label('Ijazah & Transkrip')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_layanan') === 'pengangkatan_pertama'),
                            Forms\Components\FileUpload::make('content.files.pak_pertama')->label('PAK Pertama')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_layanan') === 'pengangkatan_pertama'),

                        // Conditional Specifics
                        Forms\Components\FileUpload::make('content.files.surat_bebas_temuan_irjen')->label('Bebas Temuan Irjen')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => in_array($get('content.jabatan_tujuan'), ['guru', 'pengawas']) && $get('content.jenis_layanan') === 'pengangkatan_pertama'),
                        Forms\Components\FileUpload::make('content.files.sk_cpns')->label('SK CPNS')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jabatan_tujuan') === 'penghulu' && $get('content.jenis_layanan') === 'pengangkatan_pertama'),
                         Forms\Components\FileUpload::make('content.files.sk_pns')->label('SK PNS')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jabatan_tujuan') === 'penghulu' && $get('content.jenis_layanan') === 'pengangkatan_pertama'),

                         Forms\Components\FileUpload::make('content.files.dokumen_pendukung')->label('Dokumen Pendukung')->disk('public')->downloadable()->openable()->disabled(),

                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('tracking_code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('content.nama')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('content.jenis_layanan')
                    ->label('Layanan')
                    ->badge()
                    ->colors(['primary' => 'kenaikan_jenjang', 'success' => 'pengangkatan_pertama'])
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state))),
                 Tables\Columns\TextColumn::make('content.jabatan_tujuan')
                    ->label('Jabatan')
                    ->badge()
                    ->color('info')
                     ->formatStateUsing(fn (string $state): string => ucfirst($state)),
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
                            'admin_note' => $data['admin_note'] ?? null,
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
            'index' => Pages\ListJenjangJfSubmissions::route('/'),
        ];
    }
}
