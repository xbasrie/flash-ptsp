<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TugasBelajarSubmissionResource\Pages;
use App\Models\Submission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TugasBelajarSubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationGroup = 'Layanan Kepegawaian';
    protected static ?string $navigationLabel = 'Tugas Belajar';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $slug = 'tugas-belajar-submissions';

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->where('status', 'pending')->count() ?: null;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('service', fn($q) => $q->where('slug', 'tugas-belajar'));
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
                        Forms\Components\TextInput::make('content.jenis_tugas_belajar')->label('Jenis Tugas')->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Berkas Persyaratan')
                    ->schema([
                        Forms\Components\FileUpload::make('content.files.surat_pengantar')->label('Surat Pengantar')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.surat_pernyataan')->label('Surat Pernyataan')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.surat_perjanjian')->label('Surat Perjanjian')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.skp_2_tahun')->label('SKP 2 Tahun')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.surat_diterima')->label('Surat Diterima')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sertifikat_akreditasi')->label('Akreditasi')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.jadwal_kuliah')->label('Jadwal Kuliah')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.surat_keterangan_beasiswa')
                            ->label('Keterangan Beasiswa')
                            ->disk('public')->downloadable()->openable()->disabled()
                            ->hidden(fn ($get) => $get('content.jenis_tugas_belajar') !== 'beasiswa'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tracking_code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('content.nama')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('content.jenis_tugas_belajar')
                    ->label('Jenis')
                    ->badge()
                    ->colors(['info' => 'mandiri', 'success' => 'beasiswa']),
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
            'index' => Pages\ListTugasBelajarSubmissions::route('/'),
        ];
    }
}
