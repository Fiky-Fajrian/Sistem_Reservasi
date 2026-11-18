<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PemilikEmailDomain implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $domain = '@'.ltrim((string) config('kosku.pemilik_email_domain'), '@');

        if (str_ends_with(strtolower((string) $value), $domain)) {
            return;
        }

        $fail(sprintf(
            'Format email tidak sesuai ketentuan. Pendaftaran Pemilik Kos hanya boleh menggunakan email resmi berdomain %s yang diberikan oleh Super Admin. Belum punya? Kirim permohonan akses ke %s.',
            $domain,
            config('kosku.superadmin_email'),
        ));
    }
}
