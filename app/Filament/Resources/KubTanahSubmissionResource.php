<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KubTanahSubmissionResource\Pages;
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

class KubTanahSubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Rekomendasi Hak Atas Tanah';
    protected static ?string $pluralLabel = 'Rekomendasi Hak Atas Tanah';
    protected static ?string $slug = 'kub-tanah-submissions';
    protected static ?string $navigationGroup = 'Layanan KUB';
    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('service', function ($query) {
            $query->where('slug', 'kub-tanah');
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
                        FileUpload::make('content.files.surat_pernyataan_tidak_sengketa')
                            ->label('Surat Pernyataan Tidak Sengketa')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.surat_keterangan_domisili_badan')
                            ->label('Surat Keterangan Domisili Badan')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.npwp_badan')
                            ->label('NPWP Badan')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.ktp_pemohon')
                            ->label('KTP Pemohon')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.surat_pernyataan_keabsahan')
                            ->label('Surat Pernyataan Keabsahan')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.surat_keterangan_keberadaan_badan')
                            ->label('Keterangan Keberadaan Badan (Kanwil)')
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
                    ])
                    ->action(function (Submission $record, array $data) {
                        $record->update([
                            'status' => $data['status'],
                            'admin_note' => $data['admin_note'] ?? null,
                        ]);
                        
                        TrackingLog::create([
                            'submission_id' => $record->id,
                            'status' => $data['status'],
                            'note' => $data['note'] ?? 'Status diperbarui oleh admin',
                        ]);

                        ActivityLogger::log(
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
            'index' => Pages\ListKubTanahSubmissions::route('/'),
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
