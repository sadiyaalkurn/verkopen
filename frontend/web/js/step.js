$(function() {
    $('#stepwizard_step1_next').on('click', function(e) {
        e.preventDefault();
        var frm = $('#post-ad');
        frm.yiiActiveForm('validateAttribute', 'postad-title');
        frm.yiiActiveForm('validateAttribute', 'postad-type');
        frm.yiiActiveForm('validateAttribute', 'postad-delivery');
        frm.yiiActiveForm('validateAttribute', 'postad-text');
        var data = frm.data('yiiActiveForm');
        setTimeout(function () {
            valid = true;
            $.each(data.attributes, function () {
                if(this.id == 'postad-title'){
                    valid = valid && ($(this.container).find(this.error).html() == '');
                }
                if(this.id == 'postad-type'){
                    valid = valid && ($(this.container).find(this.error).html() == '');
                }
                if(this.id == 'postad-delivery'){
                    valid = valid && ($(this.container).find(this.error).html() == '');
                }
                if(this.id == 'postad-text'){
                    valid = valid && ($(this.container).find(this.error).html() == '');
                }
            });

            if(valid) {
                var $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                nextTab($active);
            }
        }, 500);
    });
});