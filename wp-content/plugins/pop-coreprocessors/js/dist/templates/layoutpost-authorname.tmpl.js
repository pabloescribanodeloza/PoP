!function(){var a=Handlebars.template,l=Handlebars.templates=Handlebars.templates||{};l["layoutpost-authorname"]=a({1:function(a,l,e,n,t,r,s){var u,i,o=e.helperMissing;return'<a href="'+a.escapeExpression((e.get||l&&l.get||o).call(l,l,null!=s[1]?s[1]["url-field"]:s[1],{name:"get",hash:{},data:t}))+'" class="author" '+(null!=(u=e["if"].call(l,null!=(u=null!=s[1]?s[1].targets:s[1])?u.link:u,{name:"if",hash:{},fn:a.program(2,t,0,r,s),inverse:a.noop,data:t}))?u:"")+">"+(null!=(i=null!=(i=e["display-name"]||(null!=l?l["display-name"]:l))?i:o,u="function"==typeof i?i.call(l,{name:"display-name",hash:{},data:t}):i)?u:"")+"</a>"},2:function(a,l,e,n,t,r,s){var u;return'target="'+a.escapeExpression(a.lambda(null!=(u=null!=s[1]?s[1].targets:s[1])?u.link:u,l))+'"'},compiler:[7,">= 4.0.0"],main:function(a,l,e,n,t,r,s){var u;return null!=(u=e["with"].call(l,null!=l?l.itemObject:l,{name:"with",hash:{},fn:a.program(1,t,0,r,s),inverse:a.noop,data:t}))?u:""},useData:!0,useDepths:!0})}();