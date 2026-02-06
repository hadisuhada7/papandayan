@php
    $user = auth()->check() ? auth()->user() : null;
    $liked = $model->hasLiked($user);
    $likeCount = isset($model->likes_count) ? $model->likes_count : $model->likes()->count();
    $label = $liked ? 'Batal Suka' : 'Suka';
@endphp

@once
    @push('after-styles')
        <style>
            .likePostButton {
                align-items: center;
                background: #f5f7fb;
                border: 1px solid #d5dbe7;
                border-radius: 999px;
                color: #3c5fac;
                display: inline-flex;
                font-size: 13px;
                gap: 6px;
                padding: 4px 10px;
            }

            .likePostButton.is-liked {
                background: #e6f0ff;
                border-color: #3c5fac;
                color: #0a66c2;
            }

            .likePostButton .likePostCount {
                font-weight: 600;
            }

            .likePostButton:focus {
                outline: none;
                box-shadow: 0 0 0 2px rgba(60, 95, 172, 0.15);
            }
        </style>
    @endpush
    @push('after-scripts')
        <script>
            document.addEventListener('submit', async function (event) {
                const form = event.target;
                if (!form.classList.contains('js-like-post')) {
                    return;
                }

                event.preventDefault();

                const button = form.querySelector('.likePostButton');
                if (!button || button.disabled) {
                    return;
                }

                button.disabled = true;

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin',
                        body: new FormData(form)
                    });

                    if (!response.ok) {
                        throw new Error('Request failed');
                    }

                    const data = await response.json();
                    const liked = !!data.liked;

                    button.classList.toggle('is-liked', liked);
                    button.setAttribute('aria-pressed', liked ? 'true' : 'false');

                    const label = button.querySelector('.likePostLabel');
                    if (label) {
                        label.textContent = liked ? 'Batal Suka' : 'Suka';
                    }

                    const count = button.querySelector('.likePostCount');
                    if (count && typeof data.likes_count !== 'undefined') {
                        count.textContent = data.likes_count;
                    }

                    if (window.toastr && data.message) {
                        toastr.success(data.message);
                    }
                } catch (error) {
                    if (window.toastr) {
                        toastr.error('Gagal memproses like. Silakan coba lagi.');
                    }
                } finally {
                    button.disabled = false;
                }
            });
        </script>
    @endpush
@endonce

<div class="latestNewsUser likePost">
    <form method="POST" action="{{ route('front.like.toggle') }}" class="js-like-post">
        @csrf
        <input type="hidden" name="type" value="{{ $type }}">
        <input type="hidden" name="id" value="{{ $model->id }}">
        <button type="submit" class="likePostButton {{ $liked ? 'is-liked' : '' }}" aria-pressed="{{ $liked ? 'true' : 'false' }}">
            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            <span class="likePostLabel">{{ $label }}</span>
            <span class="likePostCount">{{ $likeCount }}</span>
        </button>
    </form>
</div>
