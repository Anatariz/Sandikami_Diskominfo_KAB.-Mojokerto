@php
    $captcha = \App\Helpers\CaptchaHelper::generate();
@endphp

<div class="captcha-component-wrapper mb-4" style="max-width: 320px;">
    <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 500;">
        <i class="ri-shield-keyhole-line" style="color: var(--color-secondary, #00d8ff); margin-right: 4px;"></i> Verifikasi Captcha <span style="color: #ef4444;">*</span>
    </label>
    
    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
        <div class="captcha-code-box" style="flex: 1; background: rgba(0, 20, 45, 0.85); border: 1px solid rgba(0, 216, 255, 0.4); padding: 10px 16px; border-radius: 8px; font-family: 'Courier New', Courier, monospace; font-size: 1.35rem; font-weight: 800; letter-spacing: 7px; color: #00d8ff; user-select: none; text-align: center; box-shadow: inset 0 2px 6px rgba(0,0,0,0.5), 0 0 10px rgba(0, 216, 255, 0.15);">
            {{ $captcha['display'] }}
        </div>
        <button type="button" class="btn-refresh-captcha" onclick="refreshCaptchaCode(this)" title="Ganti kode captcha" style="background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.2); color: #e0f2fe; width: 44px; height: 44px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; transition: all 0.2s ease;">
            <i class="ri-refresh-line"></i>
        </button>
    </div>
    
    <input type="hidden" name="captcha_hash" class="captcha-hash-field" value="{{ $captcha['hash'] }}">
    <input type="text" 
           name="captcha" 
           class="form-control captcha-input-field @error('captcha') is-invalid @enderror" 
           placeholder="Ketik 5 karakter di atas" 
           maxlength="10" 
           required 
           autocomplete="off" 
           style="text-transform: uppercase; letter-spacing: 2px; font-weight: 600;">
           
    @error('captcha')
        <div style="color: #ef4444; font-size: 0.85rem; margin-top: 6px; font-weight: 500;">
            <i class="ri-error-warning-line mr-1"></i> {{ $message }}
        </div>
    @enderror
</div>

@once
<style>
    @keyframes captchaSpin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .captcha-spinning {
        animation: captchaSpin 0.7s linear infinite;
        display: inline-block;
    }
    .btn-refresh-captcha:hover {
        background: rgba(0, 216, 255, 0.2) !important;
        border-color: #00d8ff !important;
        color: #00d8ff !important;
        transform: scale(1.05);
    }
</style>
<script>
    function refreshCaptchaCode(btn) {
        const wrapper = btn.closest('.captcha-component-wrapper');
        const box = wrapper.querySelector('.captcha-code-box');
        const hashInput = wrapper.querySelector('.captcha-hash-field');
        const textInput = wrapper.querySelector('.captcha-input-field');
        const icon = btn.querySelector('i');

        if (icon) icon.classList.add('captcha-spinning');
        btn.disabled = true;

        fetch('{{ route("captcha.refresh") }}')
            .then(res => res.json())
            .then(data => {
                box.textContent = data.display;
                hashInput.value = data.hash;
                if (textInput) {
                    textInput.value = '';
                    textInput.focus();
                }
            })
            .catch(err => {
                console.error('Gagal memperbarui captcha:', err);
            })
            .finally(() => {
                if (icon) icon.classList.remove('captcha-spinning');
                btn.disabled = false;
            });
    }
</script>
@endonce
