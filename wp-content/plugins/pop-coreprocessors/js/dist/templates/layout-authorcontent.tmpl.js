!function(){var n=Handlebars.template,e=Handlebars.templates=Handlebars.templates||{};e["layout-authorcontent"]=n({1:function(n,e,a,l,t,r,s){var o,i,d=a.helperMissing;return'	<div class="'+n.escapeExpression(n.lambda(null!=s[1]?s[1]["class"]:s[1],e))+'" '+(null!=(o=(a.generateId||e&&e.generateId||d).call(e,{name:"generateId",hash:{context:s[1]},fn:n.program(2,t,0,r,s),inverse:n.noop,data:t}))?o:"")+'>\n		<h1 class="pop-visible-embed author-title">'+(null!=(i=null!=(i=a["display-name"]||(null!=e?e["display-name"]:e))?i:d,o="function"==typeof i?i.call(e,{name:"display-name",hash:{},data:t}):i)?o:"")+"</h1>\n		"+(null!=(o=a["if"].call(e,null!=e?e["short-description-formatted"]:e,{name:"if",hash:{},fn:n.program(4,t,0,r,s),inverse:n.noop,data:t}))?o:"")+"\n		"+(null!=(o=(a.showmore||e&&e.showmore||d).call(e,null!=e?e["description-formatted"]:e,{name:"showmore",hash:{len:null!=s[1]?s[1]["description-maxlength"]:s[1]},data:t}))?o:"")+"\n	</div>\n"},2:function(n,e,a,l,t,r,s){return n.escapeExpression(n.lambda(null!=s[1]?s[1].id:s[1],e))},4:function(n,e,a,l,t){var r,s;return"<p><strong>"+(null!=(s=null!=(s=a["short-description-formatted"]||(null!=e?e["short-description-formatted"]:e))?s:a.helperMissing,r="function"==typeof s?s.call(e,{name:"short-description-formatted",hash:{},data:t}):s)?r:"")+"</strong></p>"},compiler:[7,">= 4.0.0"],main:function(n,e,a,l,t,r,s){var o;return null!=(o=a["with"].call(e,null!=e?e.itemObject:e,{name:"with",hash:{},fn:n.program(1,t,0,r,s),inverse:n.noop,data:t}))?o:""},useData:!0,useDepths:!0})}();