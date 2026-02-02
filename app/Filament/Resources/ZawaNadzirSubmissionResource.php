<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZawaNadzirSubmissionResource\Pages;
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

class ZawaNadzirSubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Pergantian Nadzir';
    protected static ?string $pluralLabel = 'Pergantian Nadzir';
    protected static ?string $slug = 'zawa-nadzir-submissions';
    protected static ?string $navigationGroup = 'Layanan Zakat & Wakaf';
    protected static ?int $navigationSort = 802;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('service', function ($query) {
            $query->where('slug', 'zawa-nadzir');
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
                
                Forms\Components\Section::make('Berkas Persyaratan')
                    ->schema([
                        FileUpload::make('content.files.rekom_kua')
                            ->label('Surat Rekomendasi KUA')
                            ->disk('public')
                            ->required()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.berita_acara')
                            ->label('Berita Acara Pergantian Nadzir')
                            ->disk('public')
                            ->required()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.akta_ikrar')
                            ->label('Akta Ikrar Wakaf')
                            ->disk('public')
                            ->required()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.pengesahan_nadzir')
                            ->label('Surat Pengesahan Nadzir')
                            ->disk('public')
                            ->required()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.surat_tanah')
                            ->label('Surat-surat Tanah')
                            ->disk('public')
                            ->required()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.kesanggupan_nadzir')
                            ->label('Surat Kesanggupan Nadzir Baru')
                            ->disk('public')
                            ->required()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.pengunduran_diri')
                            ->label('Surat Pengunduran Diri/Kematian Nadzir Lama')
                            ->disk('public')
                            ->required()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.susunan_pengurus')
                            ->label('Susunan Pengurus Nadzir Baru')
                            ->disk('public')
                            ->required()
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
            'index' => Pages\ListZawaNadzirSubmissions::route('/'),
            'create' => Pages\CreateZawaNadzirSubmission::route('/create'),
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
