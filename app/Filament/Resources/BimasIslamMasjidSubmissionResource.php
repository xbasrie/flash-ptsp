<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BimasIslamMasjidSubmissionResource\Pages;
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

class BimasIslamMasjidSubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationLabel = 'ID Masjid/Musholla';
    protected static ?string $pluralLabel = 'ID Masjid/Musholla';
    protected static ?string $slug = 'bimas-masjid-submissions';
    protected static ?string $navigationGroup = 'Layanan Bimas Islam';
    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('service', function ($query) {
            $query->where('slug', 'bimas-masjid');
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
                        Forms\Components\TextInput::make('content.email')
                            ->label('Email')
                            ->disabled(),
                    ])->columns(3),
                
                Forms\Components\Section::make('Berkas Persyaratan')
                    ->schema([
                        FileUpload::make('content.files.surat_permohonan')
                            ->label('Surat Permohonan')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.proposal')
                            ->label('Proposal')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.sk_takmir')
                            ->label('SK Takmir')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.status_tanah')
                            ->label('Bukti Status Tanah')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.surat_domisili')
                            ->label('Surat Keterangan Domisili')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.surat_tidak_konflik')
                            ->label('Surat Pernyataan Tidak Konflik')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.surat_komitmen')
                            ->label('Surat Komitmen Kebangsaan')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.foto_masjid')
                            ->label('Foto Masjid/Musholla')
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
                        
                         // Trigger email notification
                         if ($data['status'] !== 'pending') {
                             // Assuming Logic provided elsewhere or handled by Observer
                         }
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
            'index' => Pages\ListBimasIslamMasjidSubmissions::route('/'),
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
        return auth()->user()->hasRole(['super admin', 'admin bimas']);
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
