<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PensiunSubmissionResource\Pages;
use App\Models\Submission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PensiunSubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationGroup = 'Layanan Kepegawaian';
    protected static ?string $navigationLabel = 'Pensiun';
    protected static ?string $navigationIcon = 'heroicon-o-user-minus';
    protected static ?string $slug = 'pensiun-submissions';

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->where('status', 'pending')->count() ?: null;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('service', fn($q) => $q->where('slug', 'pensiun'));
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
                        Forms\Components\TextInput::make('content.jenis_pensiun')->label('Jenis Pensiun')->disabled(),
                        Forms\Components\DatePicker::make('content.tmt_pensiun')->label('TMT Pensiun')->visible(fn ($get) => in_array($get('content.jenis_pensiun'), ['bup', 'janda_duda']))->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Berkas Persyaratan')
                    ->schema([
                        // Common
                        Forms\Components\FileUpload::make('content.files.sk_cpns')->label('SK CPNS')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sk_pns')->label('SK PNS')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sk_kp_terakhir')->label('SK KP Terakhir')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.skp_1_tahun')->label('SKP 1 Tahun')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.kk')->label('Kartu Keluarga')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sk_kgb')->label('SK KGB')->disk('public')->downloadable()->openable()->disabled(),
                        
                        // Education
                        Forms\Components\Group::make([
                            Forms\Components\FileUpload::make('content.files.ijazah_sd')->label('Ijazah SD')->disk('public')->downloadable()->openable()->disabled(),
                            Forms\Components\FileUpload::make('content.files.transkrip_sd')->label('Transkrip SD')->disk('public')->downloadable()->openable()->disabled(),
                            Forms\Components\FileUpload::make('content.files.ijazah_smp')->label('Ijazah SMP')->disk('public')->downloadable()->openable()->disabled(),
                            Forms\Components\FileUpload::make('content.files.transkrip_smp')->label('Transkrip SMP')->disk('public')->downloadable()->openable()->disabled(),
                            Forms\Components\FileUpload::make('content.files.ijazah_sma')->label('Ijazah SMA')->disk('public')->downloadable()->openable()->disabled(),
                            Forms\Components\FileUpload::make('content.files.transkrip_sma')->label('Transkrip SMA')->disk('public')->downloadable()->openable()->disabled(),
                            Forms\Components\FileUpload::make('content.files.ijazah_s1')->label('Ijazah S1/Sederajat')->disk('public')->downloadable()->openable()->disabled(),
                            Forms\Components\FileUpload::make('content.files.transkrip_s1')->label('Transkrip S1/Sederajat')->disk('public')->downloadable()->openable()->disabled(),
                            Forms\Components\FileUpload::make('content.files.ijazah_s2')->label('Ijazah S2')->disk('public')->downloadable()->openable()->disabled(),
                            Forms\Components\FileUpload::make('content.files.transkrip_s2')->label('Transkrip S2')->disk('public')->downloadable()->openable()->disabled(),
                             Forms\Components\FileUpload::make('content.files.ijazah_s3')->label('Ijazah S3')->disk('public')->downloadable()->openable()->disabled(),
                            Forms\Components\FileUpload::make('content.files.transkrip_s3')->label('Transkrip S3')->disk('public')->downloadable()->openable()->disabled(),
                        ])->columns(2),

                         // BUP Specific
                        Forms\Components\FileUpload::make('content.files.surat_permohonan')->label('Surat Permohonan')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_pensiun') === 'bup'),
                        Forms\Components\FileUpload::make('content.files.akta_kelahiran_suami_istri')->label('Akta Kelahiran Suami/Istri')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => in_array($get('content.jenis_pensiun'), ['bup', 'janda_duda'])),
                        Forms\Components\FileUpload::make('content.files.buku_rekening')->label('Buku Rekening')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => in_array($get('content.jenis_pensiun'), ['bup', 'janda_duda'])),
                        Forms\Components\FileUpload::make('content.files.npwp')->label('NPWP')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => in_array($get('content.jenis_pensiun'), ['bup', 'janda_duda'])),
                        Forms\Components\FileUpload::make('content.files.ktp_suami_istri')->label('KTP Suami Istri')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => in_array($get('content.jenis_pensiun'), ['bup', 'janda_duda'])),
                        Forms\Components\FileUpload::make('content.files.pas_foto')->label('Pas Foto')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => in_array($get('content.jenis_pensiun'), ['bup', 'janda_duda'])),
                        Forms\Components\FileUpload::make('content.files.sk_jabatan_mutasi')->label('SK Jabatan/Mutasi')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => in_array($get('content.jenis_pensiun'), ['bup', 'janda_duda'])),

                        // Janda/Duda/Uzur/APS Common
                        Forms\Components\FileUpload::make('content.files.surat_pengantar')->label('Surat Pengantar')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => in_array($get('content.jenis_pensiun'), ['janda_duda', 'uzur', 'aps'])),
                        Forms\Components\FileUpload::make('content.files.akta_cerai_kematian')->label('Akta Nikah/Cerai/Kematian')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => in_array($get('content.jenis_pensiun'), ['janda_duda', 'uzur', 'aps'])),

                        // Janda/Duda
                        Forms\Components\FileUpload::make('content.files.surat_keterangan_kematian')->label('Surat Keterangan Kematian')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_pensiun') === 'janda_duda'),

                        // Uzur/APS
                        Forms\Components\FileUpload::make('content.files.dpcp')->label('DPCP')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => in_array($get('content.jenis_pensiun'), ['uzur', 'aps'])),

                        // Uzur
                         Forms\Components\FileUpload::make('content.files.surat_keterangan_dokter')->label('Surat Keterangan Dokter')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_pensiun') === 'uzur'),

                        // APS
                        Forms\Components\FileUpload::make('content.files.surat_permohonan_aps')->label('Surat Permohonan APS')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_pensiun') === 'aps'),
                        Forms\Components\FileUpload::make('content.files.surat_persetujuan_aps')->label('Surat Persetujuan APS')->disk('public')->downloadable()->openable()->disabled()->visible(fn ($get) => $get('content.jenis_pensiun') === 'aps'),

                        // Optional Common
                        Forms\Components\FileUpload::make('content.files.akta_nikah')->label('Akta Nikah')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.akta_kelahiran_anak')->label('Akta Kelahiran Anak')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sk_pmk')->label('SK PMK')->disk('public')->downloadable()->openable()->disabled(),

                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tracking_code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('content.nama')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('content.jenis_pensiun')
                    ->label('Jenis')
                    ->badge()
                    ->colors(['danger' => 'bup', 'warning' => 'janda_duda', 'gray' => 'uzur', 'info' => 'aps']),
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
            'index' => Pages\ListPensiunSubmissions::route('/'),
        ];
    }
}
