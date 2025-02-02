@extends('tiyya.index')
@section('content')
<div >
  <div id="shopify-section-template--15972021895418__form" class="shopify-section index-section">
    <div class="index-section">
      <div class="page-width page-width--narrow">
        <div class="section-header">
          <h2 class="section-header__title">
            @lang('contact.contact_us')
          </h2>
        </div>
        <div class="form-vertical">
          <form method="post" action="" id="contact-template--15972021895418__form" accept-charset="UTF-8" class="contact-form"><input type="hidden" name="form_type" value="contact" /><input type="hidden" name="utf8" value="✓" />

            <div class="grid grid--small">
              <div class="grid__item medium-up--one-half">
                <label for="ContactFormName-template--15972021895418__form">@lang('contact.name')</label>
                <input type="text" id="ContactFormName-template--15972021895418__form" class="input-full" name="contact[name]" autocapitalize="words" value="">
              </div>

              <div class="grid__item medium-up--one-half">
                <label for="ContactFormEmail-template--15972021895418__form">@lang('contact.email')</label>
                <input type="email" id="ContactFormEmail-template--15972021895418__form" class="input-full" name="contact[email]" autocorrect="off" autocapitalize="off" value="">
              </div>
            </div><label for="ContactFormPhone-template--15972021895418__form">@lang('contact.phone')</label>
            <input type="tel" id="ContactFormPhone-template--15972021895418__form" class="input-full" name="contact[phone]" pattern="[0-9\-]*" value=""><label for="ContactFormMessage-template--15972021895418__form">@lang('contact.message')</label>
            <textarea rows="5" id="ContactFormMessage-template--15972021895418__form" class="input-full" name="contact[body]"></textarea>

            <button type="submit" class="btn">
              @lang('contact.send')
            </button>


            <p data-spam-detection-disclaimer="">@lang('contact.recaptcha_disclaimer')</p>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection