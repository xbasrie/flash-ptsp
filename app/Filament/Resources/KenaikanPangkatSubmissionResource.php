<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KenaikanPangkatSubmissionResource\Pages;
use App\Models\Submission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KenaikanPangkatSubmissionResource extends Resource
{
    use \App\Filament\Traits\HasPermissionAccess;

    protected static ?string $model = Submission::class;

    protected static ?string $navigationGroup = 'Layanan Kepegawaian';
    protected static ?string $navigationLabel = 'Kenaikan Pangkat';
    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';
    protected static ?string $slug = 'kenaikan-pangkat-submissions';

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->where('status', 'pending')->count() ?: null;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('service', fn($q) => $q->where('slug', 'kenaikan-pangkat'));
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
                        Forms\Components\TextInput::make('content.jabatan')->label('Jabatan')->disabled(),
                        Forms\Components\TextInput::make('content.golongan')->label('Golongan')->disabled(),
                        Forms\Components\TextInput::make('content.jenis_kenaikan_pangkat')->label('Jenis KP')->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Berkas Persyaratan')
                    ->schema([
                        // Common
                        Forms\Components\FileUpload::make('content.files.sk_cpns')->label('SK CPNS')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sk_pns')->label('SK PNS')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.skp_1')->label('SKP Tahun 1')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.skp_2')->label('SKP Tahun 2')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sk_kp_terakhir')->label('SK KP Terakhir')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.ijazah')->label('Ijazah')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.transkrip')->label('Transkrip')->disk('public')->downloadable()->openable()->disabled(),

                        // Fungsional
                        Forms\Components\FileUpload::make('content.files.pak')->label('PAK')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_kenaikan_pangkat') === 'fungsional'),
                        Forms\Components\FileUpload::make('content.files.sk_pengangkatan_pertama_jf')->label('SK Pengangkatan Pertama JF')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_kenaikan_pangkat') === 'fungsional'),
                        Forms\Components\FileUpload::make('content.files.sk_jf_terakhir')->label('SK JF Terakhir')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_kenaikan_pangkat') === 'fungsional'),
                        Forms\Components\FileUpload::make('content.files.serdik')->label('Serdik')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_kenaikan_pangkat') === 'fungsional'),
                        Forms\Components\FileUpload::make('content.files.sk_penugasan')->label('SK Penugasan')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_kenaikan_pangkat') === 'fungsional'),
                        Forms\Components\FileUpload::make('content.files.sk_kenaikan_jenjang')->label('SK Kenaikan Jenjang')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_kenaikan_pangkat') === 'fungsional'),
                        Forms\Components\FileUpload::make('content.files.uji_kompetensi')->label('Uji Kompetensi')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_kenaikan_pangkat') === 'fungsional'),
                        Forms\Components\FileUpload::make('content.files.doc_pendidikan_baru')->label('Dok. Pendidikan Baru')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_kenaikan_pangkat') === 'fungsional'),
                        
                        // Shared / Specific
                        Forms\Components\FileUpload::make('content.files.sk_jabatan_terakhir')->label('SK Jabatan Terakhir')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sk_jabatan_atasan')->label('SK Jabatan Atasan (PLT/PLH)')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.surat_pencantuman_gelar')->label('Surat Pencantuman Gelar')->disk('public')->downloadable()->openable()->disabled(),
                        
                        Forms\Components\FileUpload::make('content.files.ujian_dinas')->label('Ujian Dinas')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => in_array($get('content.jenis_kenaikan_pangkat'), ['reguler', 'struktural'])),
                        Forms\Components\FileUpload::make('content.files.surat_pelantikan')->label('Surat Pelantikan')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_kenaikan_pangkat') === 'struktural'),
                        
                        // PI
                        Forms\Components\FileUpload::make('content.files.stl_upkp')->label('STL UPKP')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_kenaikan_pangkat') === 'penyesuaian_ijazah'),
                        Forms\Components\FileUpload::make('content.files.uraian_tugas')->label('Uraian Tugas')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_kenaikan_pangkat') === 'penyesuaian_ijazah'),

                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('tracking_code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('content.nama')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('content.jenis_kenaikan_pangkat')
                    ->label('Jenis')
                    ->badge()
                    ->colors(['purple' => 'fungsional', 'info' => 'reguler', 'success' => 'struktural', 'warning' => 'penyesuaian_ijazah']),
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
            'index' => Pages\ListKenaikanPangkatSubmissions::route('/'),
        ];
    }
}
