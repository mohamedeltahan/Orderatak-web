(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-7a41d8de"],{bd21:function(t,e,s){"use strict";s("cd3a")},cd3a:function(t,e,s){},d2f1:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"product-container container-fluid",class:{"fix-product":t.scrollPosition>0},attrs:{id:"product-review"}},[s("div",{staticClass:"product-container container"},[s("div",{staticClass:"product-details col-lg-9 col-12"},[s("div",{staticClass:"product-photo col-lg-5 col-md-6 col-12"},[s("img",{attrs:{id:"main_img",src:"https://queen-store.net/azshop/public_html/board/public_html/items-photos/"+t.item.photo_link,alt:"",srcset:""}}),s("div",{staticClass:"sub-ima"},t._l(t.photos,(function(e){return s("div",{key:e.index,staticClass:"f1_img",on:{click:function(s){return t.setImg(e)}}},[s("img",{attrs:{src:"https://queen-store.net/azshop/public_html/board/public_html/"+e,alt:"",srcset:""}})])})),0)]),s("div",{staticClass:"product-info col-lg-7 col-md-6"},[s("span",{staticClass:"product-category"},[t._v(t._s(t.item.category))]),s("h3",[t._v(t._s(t.item.name))]),s("ul",[s("li",{staticClass:"item-price"},[t.item.discount?s("span",{staticClass:"old-price"},[t._v(" "+t._s(t.item.selling_price-t.item.selling_price*(t.item.discount/100))+" L.E ")]):t._e(),t._v(" "+t._s(t.item.selling_price)+" L.E ")]),s("li",{staticClass:"product-rating"},[s("star-rating",{attrs:{increment:.5,"active-color":"#00a1e8","star-size":"20",rating:t.item.rate,"read-only":!0}})],1),s("li",{staticClass:"product-details-p"},[s("p",[t._v(" "+t._s(t.item.description)+" ")])]),t._m(0),s("li",{staticClass:"product-code"},[s("span",[t._v(" product code : ")]),t._v(" "+t._s(t.item.code)+" ")]),s("li",{staticClass:"product-code d-none"},[s("span",[t._v(" quantity : ")]),t._v(" "+t._s(t.item.quantity)+" ")]),s("li",{staticClass:"product-size"},[s("span",[t._v(" size: ")]),s("select",{attrs:{name:"sizes",id:"size-select"},on:{change:function(e){return t.getItemSize(e)}}},t._l(t.sizes,(function(e){return s("option",{key:e,domProps:{value:e}},[t._v(t._s(e))])})),0)]),s("li",{staticClass:"product-quantity"},[s("span",[t._v("quantity:")]),s("button",{staticClass:"minus",on:{click:t.decrementQuantity}},[t._v(" - ")]),s("input",{attrs:{type:"number",name:"quantity"},domProps:{value:t.selectedQuantity}}),s("button",{staticClass:"plus",on:{click:t.incrementQuantity}},[t._v(" + ")])]),s("li",{staticClass:"add-to-cart"},[s("button",{on:{click:function(e){return t.addItemToCart()}}},[s("font-awesome-icon",{attrs:{icon:["fas","shopping-basket"]}}),t._v(" add to cart ")],1)])])])]),s("div",{staticClass:"product-colors col-lg-3 col-12"},[s("div",{staticClass:"product-colors-head"},[t._v(" choose color ")]),s("div",{staticClass:"product-colors-sec"},[s("ul",t._l(t.colors,(function(e){return s("li",{key:e.num,class:e.state},[s("span",{style:{"--pro-color":e.color},attrs:{"data-color":e.color},on:{click:function(s){return t.selectcolor(s,e.num)}}}),s("div",{staticClass:"check-icon"},[s("font-awesome-icon",{attrs:{icon:["fas","check"]}})],1)])})),0)])])]),s("div",{staticClass:"related-products-container container-fluid d-none"},[s("div",{staticClass:"related-products container"},[s("div",{staticClass:"related-product-header"},[t._m(1),s("div",{staticClass:"related-products-sec items"},t._l(t.items,(function(t){return s("Item",{key:t.id,attrs:{views:t.views,productname:t.productname,category:t.category,sale:t.sale,oldprice:t.oldprice,currentprice:t.currentprice,currentrating:t.currentrating,rate:t.rate,ratingselected:t.ratingselected,selectedrating:t.selectedrating}})})),1)])])])])},o=[function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("li",{staticClass:"product-availabilty"},[s("span",[t._v(" availability: ")]),t._v(" in stock ")])},function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"header"},[s("div",{staticClass:"header-title"},[s("span",[t._v("related products")])])])}],c=s("bc3a"),a=s.n(c),r=s("5b3d"),n=s.n(r),l=s("c049"),d={name:"product",components:{StarRating:n.a,Item:l["a"]},el:"#product-review",data:function(){return{scrollPosition:null,productQuantity:"55",selectedQuantity:"1",item_id:this.$route.params.itemId,item:{},colors:[],selectedColor:"",user_token:"",selectedSize:"",sizes:[],photos:[]}},methods:{updateScroll:function(){this.scrollPosition=window.scrollY},selectcolor:function(t,e){this.sizes=[];for(var s=0;s<this.colors.length;s++)s+1==e?(this.colors[s].state="active",this.selectedColor=t.target.getAttribute("data-color"),this.sizes.push(this.colors[s].sizes)):this.colors[s].state="not-active"},getItemSize:function(t){this.selectedSize=t.target.value},decrementQuantity:function(){this.selectedQuantity>1&&this.selectedQuantity--},incrementQuantity:function(){this.selectedQuantity<this.productQuantity&&this.selectedQuantity++},addItemToCart:function(){var t=this;""!=this.selectedColor?(this.user_token=localStorage.getItem("user_token"),a.a.get("https://queen-store.net/azshop/public_html/board/public_html/api/storecart",{headers:{Authorization:"Bearer "+this.user_token},params:{items_ids:[this.item_id],quantity:[this.selectedQuantity],color:[this.selectedColor],size:[this.selectedSize]}}).then((function(){t.$router.push("/products"),location.reload()}))):alert("Please select A Color")},setImg:function(t){var e=document.getElementById("main_img");e.setAttribute("src","http://hawa-scarves.com/board/public_html/"+t)}},mounted:function(){var t=this,e=0;window.addEventListener("scroll",this.updateScroll),a.a.get("https://queen-store.net/azshop/public_html/board/public_html/api/items/"+this.item_id).then((function(s){t.item=s.data,t.sizes=s.data.sizes,t.selectedSize=s.data.sizes[0],t.productQuantity=s.data.quantity,t.photos=s.data.photos;var i=0;for(i;i<t.item.colors.length;i++)for(var o=0;o<t.item.colors[i].length;o++)e+=1,t.colors.push({num:e,color:t.item.colors[i][o].color,color_code:t.item.colors[i][o].color_code,sizes:t.item.colors[i][o].size,state:"not-active"})}))}},u=d,p=(s("bd21"),s("2877")),m=Object(p["a"])(u,i,o,!1,null,null,null);e["default"]=m.exports}}]);
//# sourceMappingURL=chunk-7a41d8de.96d5a6a7.js.map