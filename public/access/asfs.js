!function (r, e) {
    function t() {
        e.BaseGateway.call(this, wc_stripe_credit_card_params), e.CheckoutGateway.call(this), window.addEventListener("hashchange", this.hashchange.bind(this)), (e.credit_card = this).confirmedSetupIntent = !1, this.has3DSecureParams()
    }

    var i = {focus: "focused", empty: "empty", invalid: "invalid"};
    (t.prototype = r.extend({}, e.BaseGateway.prototype, e.CheckoutGateway.prototype)).mappings = {
        cardNumber: "#stripe-card-number",
        cardExpiry: "#stripe-exp",
        cardCvc: "#stripe-cvv"
    }, t.prototype.initialize = function () {
        r(document.body).on("click", "#place_order", this.place_order.bind(this)), this.setup_card(), this.can_create_setup_intent() && this.create_setup_intent()
    }, t.prototype.setup_card = function () {
        var e;
        this.is_custom_form() ? (e = r.extend(!0, {classes: i}, this.params.cardOptions), ["cardNumber", "cardExpiry", "cardCvc"].forEach(function (t) {
            this[t] = this.elements.create(t, r.extend(!0, {}, e, this.params.customFieldOptions[t]))
        }.bind(this)), this.cardNumber.on("change", this.card_number_change.bind(this)), this.cardNumber.on("change", this.on_input_change.bind(this)), this.cardExpiry.on("change", this.on_input_change.bind(this)), this.cardCvc.on("change", this.on_input_change.bind(this)), this.fields.required("billing_postcode") && "" !== this.fields.get("billing_postcode") && 0 < r("#stripe-postal-code").length && (r("#stripe-postal-code").val(this.fields.get("billing_postcode")), this.validate_postal_field()), r(document.body).on("change", "#billing_postcode", function (t) {
            var e = r("#billing_postcode").val();
            r("#stripe-postal-code").val(e).trigger("keyup")
        }.bind(this))) : (this.card = this.elements.create("card", r.extend(!0, {}, {
            value: {postalCode: this.fields.get("billing_postcode", "")},
            hidePostalCode: this.fields.required("billing_postcode"),
            iconStyle: "default"
        }, this.params.cardOptions)), r(document.body).on("change", "#billing_postcode", function (t) {
            this.card && this.card.update({value: r("#billing_postcode").val()})
        }.bind(this))), setInterval(this.create_card_element.bind(this), 2e3)
    }, t.prototype.validate_postal_field = function () {
        var t, e;
        r("#billing_postcode").length && r("#stripe-postal-code").length ? this.params.postal_regex[this.fields.get("billing_country")] ? (e = this.params.postal_regex[this.fields.get("billing_country")], t = r("#stripe-postal-code").val(), e = new RegExp(e, "i"), "" !== t ? null !== e.exec(t) ? r("#stripe-postal-code").addClass("StripeElement--complete").removeClass("invalid") : r("#stripe-postal-code").removeClass("StripeElement--complete").addClass("invalid") : r("#stripe-postal-code").removeClass("StripeElement--complete").removeClass("invalid")) : 0 != r("#stripe-postal-code").val() ? r("#stripe-postal-code").addClass("StripeElement--complete") : r("#stripe-postal-code").removeClass("StripeElement--complete") : r("#stripe-postal-code").length && ("" != r("#stripe-postal-code").val() ? r("#stripe-postal-code").addClass("StripeElement--complete") : r("#stripe-postal-code").removeClass("StripeElement--complete"))
    }, t.prototype.create_card_element = function () {
        this.is_custom_form() ? r("#wc-stripe-cc-custom-form").length && 0 == r("#wc-stripe-cc-custom-form").find("iframe").length && (r(this.mappings.cardNumber).length && (this.cardNumber.mount(this.mappings.cardNumber), r(this.mappings.cardNumber).prepend(this.params.html.card_brand)), r(this.mappings.cardExpiry).length && this.cardExpiry.mount(this.mappings.cardExpiry), r(this.mappings.cardCvc).length && this.cardCvc.mount(this.mappings.cardCvc), r("#stripe-postal-code").length && (r("#stripe-postal-code, .postalCode").on("focus", function (t) {
            r("#stripe-postal-code").addClass("focused")
        }.bind(this)), r("#stripe-postal-code, .postalCode").on("blur", function (t) {
            r("#stripe-postal-code").removeClass("focused").trigger("keyup")
        }.bind(this)), r("#stripe-postal-code").on("keyup", function (t) {
            0 == r("#stripe-postal-code").val() ? r("#stripe-postal-code").addClass("empty") : r("#stripe-postal-code").removeClass("empty")
        }.bind(this)), r("#stripe-postal-code").on("change", this.validate_postal_field.bind(this)), r("#stripe-postal-code").trigger("change"))) : r("#wc-stripe-card-element").length && 0 == r("#wc-stripe-card-element").find("iframe").length && (this.card.unmount(), this.card.mount("#wc-stripe-card-element"), this.card.update({
            value: {postalCode: this.fields.get("billing_postcode", "")},
            hidePostalCode: this.fields.required("billing_postcode")
        })), r(this.container).outerWidth(!0) < 450 ? r(this.container).addClass("stripe-small-container") : r(this.container).removeClass("stripe-small-container")
    }, t.prototype.place_order = function (t) {
        if (this.is_gateway_selected()) if (this.can_create_setup_intent() && !this.is_saved_method_selected() && this.checkout_fields_valid()) {
            if (t.preventDefault(), this.confirmedSetupIntent) return this.on_setup_intent_received(this.confirmedSetupIntent.payment_method);
            this.stripe.confirmCardSetup(this.client_secret, {
                payment_method: {
                    card: this.is_custom_form() ? this.cardNumber : this.card,
                    billing_details: function () {
                        return this.is_current_page("checkout") ? this.get_billing_details() : r.extend({}, this.is_custom_form() ? {address: {postal_code: r("#stripe-postal-code").val()}} : {})
                    }.bind(this)()
                }
            }).then(function (t) {
                t.error ? this.submit_error(t.error) : (this.confirmedSetupIntent = t.setupIntent, this.on_setup_intent_received(t.setupIntent.payment_method))
            }.bind(this))
        } else this.payment_token_received || this.is_saved_method_selected() || (t.preventDefault(), this.checkout_fields_valid() && this.stripe.createPaymentMethod({
            type: "card",
            card: this.is_custom_form() ? this.cardNumber : this.card,
            billing_details: this.get_billing_details()
        }).then(function (t) {
            if (t.error) return this.submit_error(t.error);
            this.on_token_received(t.paymentMethod)
        }.bind(this)))
    }, t.prototype.checkout_place_order = function () {
        return this.is_saved_method_selected() || this.payment_token_received ? e.CheckoutGateway.prototype.checkout_place_order.apply(this, arguments) : (this.place_order.apply(this, arguments), !1)
    }, t.prototype.create_setup_intent = function () {
        return new Promise(function (e, t) {
            r.when(r.ajax({
                method: "POST",
                dataType: "json",
                url: this.params.routes.setup_intent,
                beforeSend: this.ajax_before_send.bind(this)
            })).done(function (t) {
                t.code ? this.submit_error(t.message) : this.client_secret = t.intent.client_secret, e(t)
            }.bind(this)).fail(function (t, e, i) {
                this.submit_error(i)
            }.bind(this))
        }.bind(this))
    }, t.prototype.on_token_received = function (t) {
        this.payment_token_received = !0, this.set_nonce(t.id), this.get_form().submit()
    }, t.prototype.on_setup_intent_received = function (t) {
        this.payment_token_received = !0, this.set_nonce(t), this.get_form().submit()
    }, t.prototype.updated_checkout = function () {
        this.create_card_element(), this.can_create_setup_intent() && !this.client_secret && this.create_setup_intent()
    }, t.prototype.update_checkout = function () {
        this.clear_card_elements()
    }, t.prototype.show_payment_button = function () {
        e.CheckoutGateway.prototype.show_place_order.apply(this, arguments)
    }, t.prototype.hide_place_order = function () {
    }, t.prototype.is_custom_form = function () {
        return "1" === this.params.custom_form
    }, t.prototype.get_element_options = function () {
        return this.params.elementOptions
    }, t.prototype.get_postal_code = function () {
        return this.is_custom_form() && 0 < r("#stripe-postal-code").length ? r("#stripe-postal-code").val() : this.fields.get("billing_postcode", null)
    }, t.prototype.card_number_change = function (t) {
        "unknown" === t.brand ? r("#wc-stripe-card").removeClass("active") : r("#wc-stripe-card").addClass("active"), r("#wc-stripe-card").attr("src", this.params.cards[t.brand])
    }, t.prototype.on_input_change = function (t) {
        if (t.complete) {
            var e = r("#wc-stripe-cc-custom-form").find(".StripeElement, #stripe-postal-code"), i = [];
            e.each(function (t, e) {
                i.push("#" + r(e).attr("id"))
            }.bind(this));
            var t = this.mappings[t.elementType], s = i.indexOf(t);
            if ("undefined" != typeof i[s + 1]) if ("#stripe-postal-code" === i[s + 1]) document.getElementById("stripe-postal-code").focus(); else for (var o in this.mappings) this.mappings[o] === i[s + 1] && this[o].focus()
        }
    }, t.prototype.clear_card_elements = function () {
        for (var t = ["cardNumber", "cardExpiry", "cardCvc"], e = 0; e < t.length; e++) this[t[e]] && this[t[e]].clear()
    }, t.prototype.checkout_error = function () {
        this.is_gateway_selected() && (this.payment_token_received = !1), e.CheckoutGateway.prototype.checkout_error.call(this)
    }, t.prototype.get_billing_details = function () {
        var t = e.BaseGateway.prototype.get_billing_details.call(this);
        return t.address.postal_code = this.get_postal_code(), t
    }, t.prototype.can_create_setup_intent = function () {
        return this.is_add_payment_method_page() || this.is_change_payment_method() || this.is_current_page("checkout") && this.cart_contains_subscription() && this.get_gateway_data() && 0 == this.get_total_price_cents() || this.is_current_page("checkout") && "undefined" != typeof wc_stripe_preorder_exists || this.is_current_page("order_pay") && "pre_order" in this.get_gateway_data() && !0 === this.get_gateway_data().pre_order
    }, new t
}(jQuery, window.wc_stripe);