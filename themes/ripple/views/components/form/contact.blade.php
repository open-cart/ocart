@props(['id' => 'form-contact'])

<div id="{!! $id !!}" x-data="contact('#{{ $id }}')" class="form-contact bg-white max-w-xl p-10 pt-8 shadow-md">
    <div class="mb-4">
        <h1 class="text-4xl font-extrabold capitalize">Bạn cần tư vấn mua bất động sản?</h1>
    </div>
    <div class="mb-4">
        <div class="mb-4">
            <div class="relative">
                <x-theme::form.input type="text" class="pl-12" placeholder="Họ tên" name="name" required/>
                <x-theme::icons.user-circle class="w-5 text-gray-400 absolute top-1/2 left-4 transform -translate-y-2/4"/>
            </div>
        </div>
        <div class="mb-4">
            <div class="relative">
                <x-theme::form.input type="text" class="pl-12" placeholder="Số điện thoại" name="phone" required/>
                <x-theme::icons.phone class="w-5 text-gray-400 absolute top-1/2 left-4 transform -translate-y-2/4"/>
            </div>
        </div>
        <div class="mb-4">
            <div class="relative">
                <x-theme::form.input type="text" class="pl-12" placeholder="Email" name="email" required/>
                <x-theme::icons.mail class="w-5 text-gray-400 absolute top-1/2 left-4 transform -translate-y-2/4"/>
            </div>
        </div>
        <div class="mb-4">
            <div class="relative">
                <x-theme::form.textarea class="pl-12" placeholder="Nội dung" name="content" required/>
            </div>
        </div>
        <div class="hero-search-action">
            <button x-on:click="submit()" type="button" class="btn text-xl text-white bg-blue-600 p-5 w-full text-center rounded-md">
                <x-theme::icons.loading class="loading-icon animate-spin -ml-1 mr-3 text-white" style="display: none"/>
                Gửi cho chúng tôi
            </button>
        </div>
    </div>
</div>
<script type="text/javascript">
    function contact(id) {
        return {
            showError(e) {
                if (e?.errors) {
                    toast.error(Object.values(e.errors).find(Boolean));

                    var keyserror = Object.keys(e.errors)
                    if (keyserror) {
                        for (x in keyserror) {
                            $(id + " input[name=" + keyserror[x] + "]").addClass('text-red-600 border border-red-500 error:focus:border-red-500');
                        }
                    }

                } else {
                    toast.error(e.message);
                }
            },

            submit() {
                $(".loading-icon").show();
                const name = $(id + " input[name=name]").val();
                const phone = $(id + " input[name=phone]").val();
                const email = $(id + " input[name=email]").val();
                const content = $(id + " input[name=content]").val() || 'Nội dung';

                $(".form-contact input").removeClass('text-red-600 border border-red-500 error:focus:border-red-500');

                return axios.post('contact/send', {
                    name: name,
                    phone: phone,
                    email: email,
                    content: content,
                }).then((res) => {
                    $(".form-contact input").val("");
                    toast.success(res.message);
                }).catch(this.showError).finally(() => {
                    $(".loading-icon").hide();
                });
            }

        }
    }
</script>