<?php

namespace App\Livewire\Public;

use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class JenjangJfForm extends Component
{
    use WithFileUploads;
    use \App\Traits\ChecksServiceStatus;

    public function boot()
    {
        $this->checkServiceAvailability('jenjang-jf');
    }

    public $nama;
    public $email;
    public $nip;
    public $no_hp;
    public $unit_kerja;
    public $jabatan_saat_ini;
    public $golongan;
    
    // Service Specific Logic
    public $jenis_layanan; // 'kenaikan_jenjang', 'pengangkatan_pertama'
    public $jabatan_tujuan; // 'guru', 'pengawas', 'penghulu', 'penyuluh', 'lainnya'

    // Files
    public $surat_din_usulan;
    public $surat_persetujuan;
    public $sptjm;
    public $hasil_evaluasi_kinerja;
    public $surat_pernyataan_tidak_hukuman;
    public $surat_pernyataan_tidak_tugas_belajar;
    public $surat_pernyataan_tidak_pidana;
    public $sk_cpns; // Specific to Penghulu Pertama or General
    public $sk_pns; // Specific to Penghulu Pertama
    public $sk_kp_terakhir;
    public $sk_jabatan_terakhir;
    public $skp_2_tahun;
    public $pak_konvensional;
    public $pak_konversi;
    public $sertifikat_uji_kompetensi;
    public $anjab_abk;
    public $dokumen_pendukung;
    
    // Pengangkatan Pertama Specific
    public $surat_keterangan_sehat;
    public $surat_keterangan_integritas;
    public $ijazah_transkrip;
    public $pak_pertama;
    public $surat_bebas_temuan_irjen; // Guru & Pengawas

    public $tracking_code;

    protected function rules()
    {
        $rules = [
            'jenis_layanan' => 'required|in:kenaikan_jenjang,pengangkatan_pertama',
            'jabatan_tujuan' => 'required|in:guru,pengawas,penghulu,penyuluh,lainnya',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nip' => 'required|string|max:20',
            'no_hp' => 'required|string|max:20',
            'unit_kerja' => 'required|string|max:255',
            'jabatan_saat_ini' => 'required|string|max:255',
            'golongan' => 'required|string',
            
            // Common to all
            'surat_din_usulan' => 'required|file|mimes:pdf|max:2048',
            'surat_persetujuan' => 'required|file|mimes:pdf|max:2048',
            'sptjm' => 'required|file|mimes:pdf|max:2048',
            'hasil_evaluasi_kinerja' => 'required|file|mimes:pdf|max:2048',
            'surat_pernyataan_tidak_hukuman' => 'required|file|mimes:pdf|max:2048',
            'surat_pernyataan_tidak_tugas_belajar' => 'required|file|mimes:pdf|max:2048',
            'surat_pernyataan_tidak_pidana' => 'required|file|mimes:pdf|max:2048',
            'sk_kp_terakhir' => 'required|file|mimes:pdf|max:2048',
            'sk_jabatan_terakhir' => 'required|file|mimes:pdf|max:2048',
            'skp_2_tahun' => 'required|file|mimes:pdf|max:2048',
            'sertifikat_uji_kompetensi' => 'required|file|mimes:pdf|max:2048',
            'anjab_abk' => 'required|file|mimes:pdf|max:5120',
        ];

        if ($this->jenis_layanan === 'kenaikan_jenjang') {
            $rules['pak_konvensional'] = 'required|file|mimes:pdf|max:2048';
            $rules['pak_konversi'] = 'required|file|mimes:pdf|max:2048';
        }

        if ($this->jenis_layanan === 'pengangkatan_pertama') {
            $rules['surat_keterangan_sehat'] = 'required|file|mimes:pdf|max:2048';
            $rules['surat_keterangan_integritas'] = 'required|file|mimes:pdf|max:2048';
            $rules['ijazah_transkrip'] = 'required|file|mimes:pdf|max:5120';
            $rules['pak_pertama'] = 'required|file|mimes:pdf|max:2048';
            
            if (in_array($this->jabatan_tujuan, ['guru', 'pengawas'])) {
                $rules['surat_bebas_temuan_irjen'] = 'required|file|mimes:pdf|max:2048';
            }
            
            if ($this->jabatan_tujuan === 'penghulu') {
                 $rules['sk_cpns'] = 'required|file|mimes:pdf|max:2048';
                 $rules['sk_pns'] = 'required|file|mimes:pdf|max:2048';
            }
        }

        // Optional/Support
        $rules['dokumen_pendukung'] = 'nullable|file|mimes:pdf|max:10240';

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'jenjang-jf')->firstOrFail();

        $files = [];
        $file_fields = [
            'surat_din_usulan', 'surat_persetujuan', 'sptjm', 'hasil_evaluasi_kinerja',
            'surat_pernyataan_tidak_hukuman', 'surat_pernyataan_tidak_tugas_belajar',
            'surat_pernyataan_tidak_pidana', 'sk_cpns', 'sk_pns', 'sk_kp_terakhir',
            'sk_jabatan_terakhir', 'skp_2_tahun', 'pak_konvensional', 'pak_konversi',
            'sertifikat_uji_kompetensi', 'anjab_abk', 'dokumen_pendukung',
            'surat_keterangan_sehat', 'surat_keterangan_integritas', 'ijazah_transkrip',
            'pak_pertama', 'surat_bebas_temuan_irjen'
        ];

        foreach ($file_fields as $field) {
            if ($this->$field) {
                $files[$field] = $this->$field->store('attachments/jenjang-jf', 'public');
            }
        }

        $code = 'JF-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

        $submission = Submission::create([
            'service_id' => $service->id,
            'tracking_code' => $code,
            'status' => 'pending',
            'content' => [
                'nama' => $this->nama,
                'email' => $this->email,
                'nip' => $this->nip,
                'no_hp' => $this->no_hp,
                'unit_kerja' => $this->unit_kerja,
                'jabatan_saat_ini' => $this->jabatan_saat_ini,
                'golongan' => $this->golongan,
                'jenis_layanan' => $this->jenis_layanan,
                'jabatan_tujuan' => $this->jabatan_tujuan,
                'files' => $files,
            ],
        ]);

        TrackingLog::create([
            'submission_id' => $submission->id,
            'status' => 'pending',
            'note' => 'Permohonan Jenjang JF (' . ucwords(str_replace('_', ' ', $this->jenis_layanan)) . ' - ' . ucfirst($this->jabatan_tujuan) . ') baru diajukan.',
        ]);

        $this->reset();
        $this->tracking_code = $code;

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.jenjang-jf-form')->layout('components.layouts.app');
    }
}
