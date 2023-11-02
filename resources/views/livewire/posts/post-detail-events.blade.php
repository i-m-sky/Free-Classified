<div>
    @if (isset($post['phone']) && $post['phone'] == 1)
        <div class="contact-with">
            <!-- <h5><span>Contact</span> {{ Str::limit($post['user']['name'], 50, '...') }}</h5> -->
            <div class="contact-devices">
                <a class="phone"
                    @if ($phone == '') href="#" wire:click.prevent="showTelephone()" @else href="tel:{{ str_replace('-', '', $phone) }}" @endif>
                    <i class="fa-solid fa-phone-volume"></i>
                    {{ $phone }}
                </a>
                @if (isset($post['phone']) && $post['isWhatsApp'] == 1)
                    <a class="whats-app-handle" @if ($whatsAppNumber == 'Whatsapp') wire:click="showWhatsApp" @endif
                        href="https://api.whatsapp.com/send?phone=+91{{ str_replace('-', '', $post['user']['phone']) }}&text={{ urlencode('Hi I saw your Ad on KhorBro' . $post['name'] . '') }}"
                        target="_blank">
                        <i class="fa-brands fa-whatsapp"></i>
                        {{ $whatsAppNumber }}
                    </a>
                @endif
            </div>
        </div>
    @endif
    <div class="mail-section">
        @if ($isEmailSent == true)
            <div class="alert alert-success" role="alert">
                Your email sent successfull to client.
            </div>
        @else
            <h5><span>Send</span> Mail</h5>
            <form action="#" method="post" wire:submit.prevent="sendEnquiry()">
                <textarea class="message-area" cols="30" rows="3" placeholder="Your message" rows="3"
                    wire:model="message" required maxlength="255"></textarea>
                @error('message')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="email" class="mail-input-field" placeholder="name@example.com" wire:model.defer="email"
                    required maxlength="100" />
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn-submit-mail">Submit</button>
            </form>
        @endif
    </div>
</div>
