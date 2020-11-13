jQuery.extend(jQuery.expr[':'], {
    attrNameStart: function (el, _, b) {
        for (var i = 0, atts = el.attributes, n = atts.length; i < n; i++) {
            if(atts[i].nodeName.toLowerCase().indexOf(b[3].toLowerCase()) === 0) {
                return true;
            }
        }

        return false;
    }
});

(function ($) {
    /**
     * Plugin jquery para botão de excluir registro, facilita o processo de exclusão, pelo uso do atributos html5
     *
     * @author Marcelo Reis
     * @param {String | Object} tpl O template a ser utilizado
     * @param {Object} obj O objeto q sera utilizado para popular o template
     */
    $.fn.templates = function (tpl, obj, callback) {

        $(this).each(function () {

            var me = $(this);

            if(typeof tpl == "object"){
                if($(tpl.element).length > 0)
                    var template = $(tpl.element);
                else
                    var template = $($(tpl.template).clone().html());
            } else {
                var template = $($(tpl).clone().html());
            }

            if (template.length > 0) {
                funcs.build(template, obj, me, callback);
            }
        });
    };


    var funcs = {
        build: function (el, ob, toAppend, callback) {

            this.populate(el, ob);

            if($("#"+el.attr("id")).length == 0)
                toAppend.append(el);


            if(typeof callback == "function")
                callback();

        },
        populate: function (el, ob) {

            for(var i = 0; i < el[0].attributes.length ; i++){
                if(!attrOk && el[0].attributes[i].name.indexOf("data-attr-") !== -1){
                    funcs.addAttribute(el[0], ob);
                    var attrOk = true;
                }

                if(!dataOk && el[0].attributes[i].name.indexOf("data-data-") !== -1){
                    funcs.addData(el[0], ob);
                    var dataOk = true;
                }

            }

            $("[data-content]", el).each(function(){
                $(this).html(ob[$(this).data('content')]);
            });

            $.each($("*:attrNameStart('data-attr-')", el), function(){
                funcs.addAttribute(this, ob);
            });

            $.each($("*:attrNameStart('data-data-')", el), function(){
                funcs.addData(this, ob);
            });

        },
        addAttribute: function(el, ob){
            var $this = $(el);

            var aL = el.attributes.length;

            for(var i = 0; i < aL ; i++){
                if(el.attributes[i].name.indexOf("data-attr-") !== -1){
                    var attr = el.attributes[i].name.split("-");

                    attr.shift();

                    var data = attr.join("-");

                    if($this.data(data).indexOf(")") !== -1){

                        var structValue = $this.data(data);

                        var objsAttrs = $this.data(data).replace(/\(.*?\)/g, "|").split("|").filter(n => n);

                        var sv = "";

                        $(objsAttrs).each(function(i, v){
                            if(ob[v] != "" && ob[v] != undefined){
                                sv = structValue.replace(/\([^()]*\)/g, "%%");

                                sv = sv.replace(new RegExp(v, "g"), ob[v]);

                                var mt = structValue.match(/\([^()]*\)/g);

                                for(i in mt){
                                    sv = sv.replace("%%", mt[i]);
                                }
                            }
                        })

                        var val = sv.replace(/\(|\)/g, '');

                        // var curVal = $this.data(data).split(")");
                        //
                        // var val = curVal.shift().replace("(", "")+ob[curVal.pop()]
                    } else {
                        var val = ob[$this.data(data)]
                    }

                    $this.removeAttr(el.attributes[i].name);

                    $this.attr(attr.pop(), val);

                }
            }
        },
        addData: function(el, ob){
            var $this = $(el);

            var aL = el.attributes.length;

            for(var i = 0; i < aL ; i++){
                if(el.attributes[i].name.indexOf("data-data-") !== -1){
                    var data = el.attributes[i].name.split("-");

                    data.shift();

                    var dataVal = data.join("-");

                    if($this.data(dataVal).indexOf(")") !== -1){
                        var structValue = $this.data(dataVal);

                        var objsAttrs = $this.data(dataVal).replace(/\(.*?\)/g, "|").split("|").filter( n => n );

                        $(objsAttrs).each(function(i, v){
                            if(ob[v] != "" && ob[v] != undefined)
                                structValue = structValue.replace(v, ob[v]);
                        })

                        var val = structValue.replace(/\(|\)/g, '');

                    } else {
                        var val = ob[$this.data(dataVal)];
                    }

                    $this.removeAttr(el.attributes[i].name);

                    $this.attr(data.join("-"), val);
                }
            }
        }
    };


})(jQuery);