(()=>{var e,t={50:()=>{"function"==typeof $.pjax&&$(document).on("pjax:complete",(function(){$(document).find(".widget_item a.reload").trigger("click")})),$(document).ready((function(){$(document).find(".widget_item a.reload").length&&$(document).find(".widget_item a.reload").click()})),$(document).on("click",".widget_item a.reload",(function(e){e.preventDefault();var t=$(this).closest(".widget_item"),n=t.data("url"),o=$('\n    <div class="absolute top-0 left-0 w-full h-full">\n        <div class="flex justify-center items-center h-full">\n            <svg class="animate-spin -ml-1 mr-3 h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">\n                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>\n                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>\n            </svg>\n        </div>\n    </div>\n    ').clone();t.find(".widget-content").append(o),axios.get(n).then((function(e){t.find(".widget-content").html(e.data)})).finally((function(){o.remove()}))}))},737:()=>{},288:()=>{},484:()=>{},891:()=>{},677:()=>{},169:()=>{},2:()=>{},282:()=>{}},n={};function o(e){var i=n[e];if(void 0!==i)return i.exports;var l=n[e]={exports:{}};return t[e](l,l.exports,o),l.exports}o.m=t,e=[],o.O=(t,n,i,l)=>{if(!n){var r=1/0;for(d=0;d<e.length;d++){for(var[n,i,l]=e[d],c=!0,a=0;a<n.length;a++)(!1&l||r>=l)&&Object.keys(o.O).every((e=>o.O[e](n[a])))?n.splice(a--,1):(c=!1,l<r&&(r=l));c&&(e.splice(d--,1),t=i())}return t}l=l||0;for(var d=e.length;d>0&&e[d-1][2]>l;d--)e[d]=e[d-1];e[d]=[n,i,l]},o.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={448:0,139:0,494:0,989:0,933:0,35:0,170:0,999:0,588:0};o.O.j=t=>0===e[t];var t=(t,n)=>{var i,l,[r,c,a]=n,d=0;for(i in c)o.o(c,i)&&(o.m[i]=c[i]);for(a&&a(o),t&&t(n);d<r.length;d++)l=r[d],o.o(e,l)&&e[l]&&e[l][0](),e[r[d]]=0;o.O()},n=self.webpackChunk=self.webpackChunk||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))})(),o.O(void 0,[139,494,989,933,35,170,999,588],(()=>o(50))),o.O(void 0,[139,494,989,933,35,170,999,588],(()=>o(891))),o.O(void 0,[139,494,989,933,35,170,999,588],(()=>o(677))),o.O(void 0,[139,494,989,933,35,170,999,588],(()=>o(169))),o.O(void 0,[139,494,989,933,35,170,999,588],(()=>o(2))),o.O(void 0,[139,494,989,933,35,170,999,588],(()=>o(282))),o.O(void 0,[139,494,989,933,35,170,999,588],(()=>o(737))),o.O(void 0,[139,494,989,933,35,170,999,588],(()=>o(288)));var i=o.O(void 0,[139,494,989,933,35,170,999,588],(()=>o(484)));i=o.O(i)})();
