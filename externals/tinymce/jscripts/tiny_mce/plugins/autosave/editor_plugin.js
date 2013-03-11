(function (e) {
    var c = "autosave", g = "restoredraft", b = true, f, d, a = e.util.Dispatcher;
    e.create("tinymce.plugins.AutoSave", {init:function (i, j) {
        var h = this, l = i.settings;
        h.editor = i;
        function k(n) {
            var m = {s:1000, m:60000};
            n = /^(\d+)([ms]?)$/.exec("" + n);
            return(n[2] ? m[n[2]] : 1) * parseInt(n)
        }

        e.each({ask_before_unload:b, interval:"30s", retention:"20m", minlength:50}, function (n, m) {
            m = c + "_" + m;
            if (l[m] === f) {
                l[m] = n
            }
        });
        l.autosave_interval = k(l.autosave_interval);
        l.autosave_retention = k(l.autosave_retention);
        i.addButton(g, {title:c + ".restore_content", onclick:function () {
            if (i.getContent({draft:true}).replace(/\s|&nbsp;|<\/?p[^>]*>|<br[^>]*>/gi, "").length > 0) {
                i.windowManager.confirm(c + ".warning_message", function (m) {
                    if (m) {
                        h.restoreDraft()
                    }
                })
            } else {
                h.restoreDraft()
            }
        }});
        i.onNodeChange.add(function () {
            var m = i.controlManager;
            if (m.get(g)) {
                m.setDisabled(g, !h.hasDraft())
            }
        });
        i.onInit.add(function () {
            if (i.controlManager.get(g)) {
                h.setupStorage(i);
                setInterval(function () {
                    if (!i.removed) {
                        h.storeDraft();
                        i.nodeChanged()
                    }
                }, l.autosave_interval)
            }
        });
        h.onStoreDraft = new a(h);
        h.onRestoreDraft = new a(h);
        h.onRemoveDraft = new a(h);
        if (!d) {
            window.onbeforeunload = e.plugins.AutoSave._beforeUnloadHandler;
            d = b
        }
    }, getInfo:function () {
        return{longname:"Auto save", author:"Moxiecode Systems AB", authorurl:"http://tinymce.moxiecode.com", infourl:"http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/autosave", version:e.majorVersion + "." + e.minorVersion}
    }, getExpDate:function () {
        return new Date(new Date().getTime() + this.editor.settings.autosave_retention).toUTCString()
    }, setupStorage:function (i) {
        var h = this, k = c + "_test", j = "OK";
        h.key = c + i.id;
        e.each([function () {
            if (localStorage) {
                localStorage.setItem(k, j);
                if (localStorage.getItem(k) === j) {
                    localStorage.removeItem(k);
                    return localStorage
                }
            }
        }, function () {
            if (sessionStorage) {
                sessionStorage.setItem(k, j);
                if (sessionStorage.getItem(k) === j) {
                    sessionStorage.removeItem(k);
                    return sessionStorage
                }
            }
        }, function () {
            if (e.isIE) {
                i.getElement().style.behavior = "url('#default#userData')";
                return{autoExpires:b, setItem:function (l, n) {
                    var m = i.getElement();
                    m.setAttribute(l, n);
                    m.expires = h.getExpDate();
                    try {
                        m.save("TinyMCE")
                    } catch (o) {
                    }
                }, getItem:function (l) {
                    var m = i.getElement();
                    try {
                        m.load("TinyMCE");
                        return m.getAttribute(l)
                    } catch (n) {
                        return null
                    }
                }, removeItem:function (l) {
                    i.getElement().removeAttribute(l)
                }}
            }
        }, ], function (l) {
            try {
                h.storage = l();
                if (h.storage) {
                    return false
                }
            } catch (m) {
            }
        })
    }, storeDraft:function () {
        var i = this, l = i.storage, j = i.editor, h, k;
        if (l) {
            if (!l.getItem(i.key) && !j.isDirty()) {
                return
            }
            k = j.getContent({draft:true});
            if (k.length > j.settings.autosave_minlength) {
                h = i.getExpDate();
                if (!i.storage.autoExpires) {
                    i.storage.setItem(i.key + "_expires", h)
                }
                i.storage.setItem(i.key, k);
                i.onStoreDraft.dispatch(i, {expires:h, content:k})
            }
        }
    }, restoreDraft:function () {
        var h = this, j = h.storage, i;
        if (j) {
            i = j.getItem(h.key);
            if (i) {
                h.editor.setContent(i);
                h.onRestoreDraft.dispatch(h, {content:i})
            }
        }
    }, hasDraft:function () {
        var h = this, k = h.storage, i, j;
        if (k) {
            j = !!k.getItem(h.key);
            if (j) {
                if (!h.storage.autoExpires) {
                    i = new Date(k.getItem(h.key + "_expires"));
                    if (new Date().getTime() < i.getTime()) {
                        return b
                    }
                    h.removeDraft()
                } else {
                    return b
                }
            }
        }
        return false
    }, removeDraft:function () {
        var h = this, k = h.storage, i = h.key, j;
        if (k) {
            j = k.getItem(i);
            k.removeItem(i);
            k.removeItem(i + "_expires");
            if (j) {
                h.onRemoveDraft.dispatch(h, {content:j})
            }
        }
    }, "static":{_beforeUnloadHandler:function (h) {
        var i;
        e.each(tinyMCE.editors, function (j) {
            if (j.plugins.autosave) {
                j.plugins.autosave.storeDraft()
            }
            if (j.getParam("fullscreen_is_enabled")) {
                return
            }
            if (!i && j.isDirty() && j.getParam("autosave_ask_before_unload")) {
                i = j.getLang("autosave.unload_msg")
            }
        });
        return i
    }}});
    e.PluginManager.add("autosave", e.plugins.AutoSave)
})(tinymce);