
document.addEventListener("DOMContentLoaded", function() {
    var feedback_list = document.querySelector(".feedback__list");
    if (feedback_list) {
        $(feedback_list).slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            infinite: true,
            prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
            nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }
});
document.querySelectorAll("slick-dots").forEach(element => {
    console.log(element)
    element.textContent = '';
});
    // Giá sau khi sale
function priceNew(priceOld, sale) {
    var priceAfterSale = priceOld - (priceOld * sale / 100);
    return priceAfterSale.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
}
//-----------------------------------------------------------Like
function likeShoes(card) {
    var like = card.querySelector(".card-btn__like");
    if (like) {
        like.addEventListener('click', function(e) {
            e.preventDefault(); // Ngăn chặn hành vi mặc định khi click vào liên kết
            e.stopPropagation(); // Ngăn chặn nổi bọt
            if (like.classList.contains("fa-regular")) {
                like.classList.remove("fa-regular");
                like.classList.add("fa-solid");
                like.style.color = "#F02757";
            } else {
                like.classList.remove("fa-solid");
                like.classList.add("fa-regular");
                like.style.color = "";
            }
        });
    }
}
// -----------------------------------------------------------set tagHot tagNew 
// Sucess
function tagHotNew(tag_new, tag_hot, card) {
    if (tag_new == 1) {
        var newDivHot = document.createElement("div");
        newDivHot.innerHTML = `
<div class="card-special card-new">
    New
</div>
`
        card.querySelector(".card-new-hot").appendChild(newDivHot);
    }
    if (tag_hot == 1) {
        var newDivNew = document.createElement("div");
        newDivNew.innerHTML = `
    <div class="card-special card-hot">
        Hot
    </div>
    `
        card.querySelector(".card-new-hot").appendChild(newDivNew);
    }
}
//-----------------------------------------------------------insert card
function insertCard(render, divList) {
    render.forEach((element, index) => {
        var newDiv = document.createElement("div");
        newDiv.classList.add("card");
        newDiv.innerHTML = `
        <div class="card-img">
            <img src="./assets/img/` + element.img + `" alt="">
        </div>
        <p class="card-title">` + element.title + `</p>
        <div class="card-price-rate">
            <div class="card-price">
                <span>` + priceNew(element.price_old, element.sale) + `</span>
                <span><del>` + element.price_old.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }) + `</del></span>  
            </div>
            <div class="card-rate">
                <i class="fa-solid fa-star"></i>
                ` + element.rate + `
            </div>
        </div>   
        <i class="card-btn__like fa-regular fa-heart"></i>
        <div class="card-new-hot">
    
        </div>
        `
        newDiv.addEventListener('click', function(e) {
            e.stopPropagation(); //Ngăn chặn nổi bọt
            var url =
                `product-detail.html?ob=${encodeURIComponent(JSON.stringify(element))}`;
            window.location.href = url;
        })


        //get tagNew and tagHot
        tagHotNew(element.new, element.hot, newDiv);

        divList.appendChild(newDiv);
        //like
        likeShoes(newDiv);
    });
}
// var listProduct = document.querySelector(".list-shoes");
// if (listProduct) {
//     insertCard(render, listProduct);
// }


//-------------------------------------------------Show-Hidden Categories
var categories_title = document.querySelectorAll(".filter__categories-title");
if (categories_title) {
    categories_title.forEach(element => {
        element.addEventListener('click', function() {
            element.parentElement.children[1].classList.toggle("block_none");
            element.parentElement.children[0].children[1].classList.toggle("categories-title-icon");
        });
    });
}
//----------------------------------------------------Filter Hot and New
function hiddenListShoes() { // Ẩn tất cả sản phẩm
    var list_shoes = document.querySelectorAll(".card");
    list_shoes.forEach(element => {
        element.style.display = "none";
    });
}

function showListShoes() { // Hiện tất cả sản phẩm
    var list_shoes = document.querySelectorAll(".card");
    list_shoes.forEach(element => {
        element.style.display = "block";
    });
}

function sortNewHot(newHot) { // card nào có card-new thì hiện ra
    var list_shoes = document.querySelectorAll(".card");
    list_shoes.forEach(element => {
        if (element.querySelector(".card-" + newHot)) {
            element.style.display = "block";
        }
    });
}

function new_hot(new_hot) {
    if (new_hot === "new") {

    }
    this.classList.toggle("btn-sort--click");
    if (this.classList.contains("btn-sort--click")) {
        hiddenListShoes();
        sort_new();
    } else {
        showListShoes();
    }
}
// var btn_new = document.querySelector(".sort-new");
// var btn_hot = document.querySelector(".sort-hot");
// if (btn_new) {
//     btn_new.addEventListener('click', function() {
//         this.classList.toggle("btn-sort--click");
//     });
// }
// if (btn_hot) {
//     btn_hot.addEventListener('click', function() {
//         this.classList.toggle("btn-sort--click");
//     });

// }
var btnNewHot=document.querySelectorAll(".btn-sort");
btnNewHot.forEach(element=>{
    element.addEventListener('click',function(){
        element.classList.toggle("btn-sort--click");
    });
});

//----------------------------------------------------------Sort-Price
function setTextFirst() {
    btn_new.classList.remove("btn-sort--click") // Xóa màu của nút New
    btn_hot.classList.remove("btn-sort--click") // Xóa màu của nút Hot
}
//Sắp sắp mảng giảm dần giá trị
// function sortHightToLow(render) {
//     render.sort(function(a, b) {
//         return (b.price_old - (b.price_old * b.sale / 100)) - (a.price_old - (a.price_old * a.sale / 100));
//     });
//     return render;
// }
// //Sắp sắp mảng tăng dần giá trị
// function sortLowToHight(render) {
//     render.sort(function(a, b) {
//         return (a.price_old - (a.price_old * a.sale / 100)) - (b.price_old - (b.price_old * b.sale / 100));
//     });
//     return render;
// }
//Click vào nút giảm dần
// var hightToLow = document.querySelector(".sort-HightToLow");
// if (hightToLow) {
//     hightToLow.addEventListener('click', function() {
//         console.log("sadas")
//         document.querySelector(".list-shoes").innerHTML = ""
//         renderAfterSort = sortHightToLow(render);
//         insertCard(renderAfterSort, listProduct);
//         //Set Text lại ô sắp xếp theo giá
//         document.querySelector(".sort-price__title").textContent = "Price: from hight to low";
//         setTextFirst();
//     });
// }
// //Click vào nút tăng dần
// var lowToHight = document.querySelector(".sort-LowToHight");
// if (lowToHight) {
//     lowToHight.addEventListener('click', function() {
//         document.querySelector(".list-shoes").innerHTML = ""
//         renderAfterSort = sortLowToHight(render);
//         insertCard(renderAfterSort, listProduct);
//         //Set Text lại ô sắp xếp theo giá
//         document.querySelector(".sort-price__title").textContent = "Price: from low to hight";
//         setTextFirst();
//     });
// }

//----------------------------------------------------------Tag search

// !!!! Nếu xóa tag đã check thì xóa luôn dấu check
function unCheckTag(keysWords) {
    var input = document.querySelectorAll(".filter__list-item");
    input.forEach(element => {
        if (element.children[0].classList.contains("border_select")) {
            element.children[0].classList.remove("border_select"); //color
        } else if (element.children[1].textContent == keysWords) {
            element.children[0].checked = false; //input
        }
    });
}

function insertTarget(keyWords) {
    var newDiv = document.createElement("div");
    newDiv.classList.add("tagret-item");
    newDiv.innerHTML = `
    <span>` + keyWords + `</span>
    <i class="targer-icon fa-solid fa-xmark"></i>
    `
    newDiv.children[1].addEventListener('click', function() {
        newDiv.remove();
        unCheckTag(keyWords);
    });
    var target = document.querySelector(".tagret");
    if (target) {
        target.appendChild(newDiv);
    }
}

//----------------------------------------------------------On-Off Filter
var hidden_filter = document.querySelector(".hidden-filter")
if (hidden_filter) {
    hidden_filter.addEventListener('click', function() {
        hidden_filter.children[0].classList.toggle("btn-filter--off");
        //off
        var filter = document.querySelector(".filter");
        filter.classList.toggle("filter-none");
        if (filter.classList.contains("filter-none")) {
            document.querySelector(".show").classList.add("show--offFilter");
        } else {
            document.querySelector(".show").classList.remove("show--offFilter");
        }
    });
}

//----------------------------------------------------------Clicked checked categories
var filter_item = document.querySelectorAll(".filter__list-item");
filter_item.forEach(element => {
    element.addEventListener('click', function() {
        if (element.children[0].checked) {
            element.children[0].checked = false;
        } else {
            element.children[0].checked = true;
        }
    });
});

//-------------------------------------------------------------Product new 
// var listProductNew = document.querySelector(".product-new__list");
// if (listProductNew) {
//     var count = 0;
//     render.forEach((element) => {
//         if (element.new == 1 && element.hot == 0 && count <= 11) {
//             count++;
//             var newDiv = document.createElement("div");
//             newDiv.classList.add("card");
//             newDiv.innerHTML = `
//     <div class="card-img">
//         <img src="./assets/img/` + element.img + `" alt="">
//     </div>
//     <p class="card-title">` + element.title + `</p>
//     <div class="card-price-rate">
//         <div class="card-price">
//             <span>` + priceNew(element.price_old, element.sale) + `</span>
//             <span><del>` + element.price_old.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }) + `</del></span>  
//         </div>
//         <div class="card-rate">
//             <i class="fa-solid fa-star"></i>
//             ` + element.rate + `
//         </div>
//     </div>   
//     <i class="card-btn__like fa-regular fa-heart"></i>
//     <div class="card-new-hot">

//     </div>
//     `
//             newDiv.addEventListener('click', function(e) {
//                     e.stopPropagation(); //Ngăn chặn nổi bọt
//                     var url =
//                         `product-detail.html?ob=${encodeURIComponent(JSON.stringify(element))}`;
//                     window.location.href = url;
//                 })
//                 //get tagNew and tagHot
//             tagHotNew(element.new, element.hot, newDiv);

//             listProductNew.appendChild(newDiv);
//             //like
//             likeShoes(newDiv);
//         }
//     });
// }
// //-------------------------------------------------------------Product hot
// var listProductHot = document.querySelector(".product-hot__list");
// if (listProductHot) {
//     var count = 0;
//     render.forEach((element) => {
//         if (element.hot == 1 && element.new == 0 && count <= 11) {
//             count++;
//             var newDiv = document.createElement("div");
//             newDiv.classList.add("card");
//             newDiv.innerHTML = `
//     <div class="card-img">
//         <img src="./assets/img/` + element.img + `" alt="">
//     </div>
//     <p class="card-title">` + element.title + `</p>
//     <div class="card-price-rate">
//         <div class="card-price">
//             <span>` + priceNew(element.price_old, element.sale) + `</span>
//             <span><del>` + element.price_old.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }) + `</del></span>  
//         </div>
//         <div class="card-rate">
//             <i class="fa-solid fa-star"></i>
//             ` + element.rate + `
//         </div>
//     </div>   
//     <i class="card-btn__like fa-regular fa-heart"></i>
//     <div class="card-new-hot">

//     </div>
//     `
//             newDiv.addEventListener('click', function(e) {
//                     e.stopPropagation(); //Ngăn chặn nổi bọt
//                     var url =
//                         `product-detail.html?ob=${encodeURIComponent(JSON.stringify(element))}`;
//                     window.location.href = url;
//                 })
//                 //get tagNew and tagHot
//             tagHotNew(element.new, element.hot, newDiv);

//             listProductHot.appendChild(newDiv);
//             //like
//             likeShoes(newDiv);
//         }
//     });
// }
//-------------------------------------------------------------flash sale
// var listFalshSale = document.querySelector(".flashsale__list");
// if (listFalshSale) {
//     var count = 0;
//     render.forEach((element) => {
//         if (element.flashsale == 1 && count <= 5) {
//             count++;
//             var newDiv = document.createElement("div");
//             newDiv.classList.add("flashsale__item");
//             newDiv.innerHTML = `
//     <img src="./assets/img/` + element.img + `" alt="" class="flashsale__item-img">
//     <p class="flashsale__item-title">` + element.title + `</p>
//     <div class="flashsale__item-price">
//         <span>` + priceNew(element.price_old, element.sale) + `</span>
//         <span><del>` + element.price_old.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }) + `</del></span>  
//     </div> 
//     <div class="flashsale__item-timeline">

//     </div>          
//     <div class="flashsale__item-detail">
//         <span>240</span>
//         sản phầm đã bán
//     </div>      
//     `
//             newDiv.addEventListener('click', function(e) {
//                     e.stopPropagation(); //Ngăn chặn nổi bọt
//                     var url =
//                         `product-detail.html?ob=${encodeURIComponent(JSON.stringify(element))}`;
//                     window.location.href = url;
//                 })
//                 //get tagNew and tagHot
//                 // tagHotNew(element.new,element.hot,newDiv);

//             listFalshSale.appendChild(newDiv);
//             //like
//             likeShoes(newDiv);
//         }
//     });
// }

//get các từ khóa từ search và filter
function getSearch() {
    var arr = [];
    var tagret_item = document.querySelectorAll(".tagret-item");
    tagret_item.forEach(element => {
        var key = element.children[0].textContent.toLowerCase();
        arr.push(key);
    });
    return arr;
}

// function searchObjectsByKeywords(objects, keywords) {
//     var temp = []; // Danh sách mảng đối tượng tìm thấy
//     if (keywords.length === 0) {
//         temp = render;
//         console.log(temp);
//         return temp;

//     } else {
//         objects.forEach(obj => {
//             for (const key in obj) {
//                 if (obj.hasOwnProperty(key)) {
//                     const value = obj[key];
//                     if (typeof value === "string") {
//                         const lowercaseValue = value.toLowerCase();
//                         if (keywords.some(keyword => lowercaseValue.includes(keyword))) {
//                             temp.push(obj);
//                             break; // Đã tìm thấy, thoát khỏi vòng lặp
//                         }
//                     } else if (typeof value === "number" || typeof value === "boolean") {
//                         // Kiểm tra kiểu số hoặc kiểu boolean
//                         const stringValue = String(value).toLowerCase();
//                         if (keywords.some(keyword => stringValue.includes(keyword))) {
//                             temp.push(obj);
//                             break; // Đã tìm thấy, thoát khỏi vòng lặp
//                         }
//                     }
//                     // Bạn có thể thêm các trường hợp kiểu dữ liệu khác ở đây
//                 }
//             }
//         });
//         console.log(temp);
//         return temp;
//     }
// }

// function resultSearch() {
//     document.querySelector(".list-shoes").innerHTML = "";
//     var arr = []
//     var arrObject = searchObjectsByKeywords(render, getSearch());
//     for (var i = 0; i < render.length; i++) {
//         for (var j = 0; j < arrObject.length; j++) {
//             if (render[i].id === arrObject[j].id) {
//                 arr.push(render[i]);
//             }
//         }
//     }
//     insertCard(arr, listProduct);
// }



//----------------------------------------------select filter color
// var inputColor=document.querySelectorAll(".filter__list-item-color");
// console.log(inputColor);
// inputColor.forEach(element=>{
//   element.addEventListener('click',function(){
//     element.children[0].classList.toggle("border_select");
//   })
// });
// ----------------------------------------------check filter and insert tag filter
function closeTag(keysWords) { // xóa những tag có tên là keywords
    var tagret_item = document.querySelectorAll(".tagret-item");
    tagret_item.forEach(element => {
        if (element.children[0].textContent === keysWords) {
            element.remove();
        }
    });
}

function closeNoCheckInputFilter(arr, select) { // xóa các tag khi kh được check
    if (select == "input") {
        arr.forEach(element => {
            if (element.children[0].checked === false) {
                closeTag(element.children[1].textContent);
            }
        });
    } else if (select == "color") {
        arr.forEach(element => {
            if (element.classList.contains("border_select") === false) {
                closeTag(element.nextElementSibling.textContent);
            }
        });
    }
}

function checkInputCheckFilter() {
    var input = document.querySelectorAll(".filter__list-item-text");
    input.forEach(element => {
        element.addEventListener('click', function() {
            if (element.children[0].checked) {
                insertTarget(element.children[0].value);
                closeNoCheckInputFilter(input, "input");
            } else {
                closeNoCheckInputFilter(input, "input");
            }
        });
    });
};
checkInputCheckFilter();



// --------------------------------ProductDetail
// describle-select
function removeSelectAll() {
    var menu = document.querySelectorAll(".describe__menu-sub");
    menu.forEach(element => {
        element.classList.remove("describe--primary");
    });
}

function offAllDescribe() {
    var describe = document.querySelectorAll(".describe-select");
    describe.forEach(element => {
        element.classList.add("none");
    });
}

function selectDescribe() {
    var menu = document.querySelectorAll(".describe__menu-sub");
    menu.forEach(element => {
        element.addEventListener('click', function() {
            removeSelectAll();
            element.classList.add("describe--primary");
            offAllDescribe();
            console.log("describe");
            // if(element.classList.contains("describe__menu-sub_view")){
            //   var view = document.querySelector(".describe-detail");
            //   view.classList.remove("none");
            //   console.log("1");
            // }
            if (element.classList.contains("describe__menu-sub_size")) {
                var size = document.querySelector(".describe-size");
                size.classList.remove("none");
                console.log("2");
            }
            if (element.classList.contains("describe__menu-sub_delivery")) {
                // var view = document.querySelector(".describe-detail");
                // view.classList.remove("none");
            }
            if (element.classList.contains("describe__menu-sub_reviews")) {
                var reviews = document.querySelector(".describe-reviews");
                reviews.classList.remove("none");
                console.log("4");
            }
            // if(element.classList.contains("describe__menu-sub_view")){
            //   element.classList.add();
            // }
        });
    });
}
selectDescribe();


//-------------product-detail___useful-comment
var useful = document.querySelectorAll(".describe-reviews_detail-like");
useful.forEach(element => {
    element.addEventListener('click', function() {
        console.log("Click");
        element.children[0].classList.toggle("describe-reviews_detail-like--select-icon");

        element.classList.toggle("describe-reviews_detail-like--select-box");
    });
});
// --------------------------------------------------page
function removeClasslist(list, str) {
    list.forEach(element => {
        element.classList.remove(str);
    });
}

// var sortPriceItems = document.querySelectorAll('.sort-price__item');
// var sortPrice = document.querySelector('.sort-price');
// var listSort = document.querySelector('.sort-price__list');
// sortPrice.addEventListener('click', function(){
//     listSort.classList.toggle('block');
// });
// sortPriceItems.forEach(sortPriceItem => {
//     sortPriceItem.addEventListener('click', function(){
        
//     });
// });
const rangeInput = document.querySelectorAll(".range-input input"),
priceInput = document.querySelectorAll(".price-input input"),
range = document.querySelector(".slider .progress");
let priceGap = 1000;

priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
        maxPrice = parseInt(priceInput[1].value);
        
        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
            if(e.target.className === "input-min"){
                rangeInput[0].value = minPrice;
                range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
            }else{
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});

rangeInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput[0].value),
        maxVal = parseInt(rangeInput[1].value);

        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min"){
                rangeInput[0].value = maxVal - priceGap
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});





// product-detail select size
function removeSelectSize(){
    var selectSize=document.querySelectorAll(".detail-content__size-item");
    selectSize.forEach(element=>{
        element.classList.remove("detail-content__size-item--select");

    });
}
var selectSize=document.querySelectorAll(".detail-content__size-item");
selectSize.forEach(element=>{
    element.addEventListener('click',function(){
        if(element.classList.contains("detail-content__size-item--disable")==false){
            removeSelectSize();
            element.classList.add("detail-content__size-item--select");   
        }
    });
});
//product-detail quanlity
function increaseQuantity() {
    var inputElement = document.getElementById("quantity");
    var currentValue = parseInt(inputElement.value);
    inputElement.value = currentValue + 1;
    var stock=document.querySelector(".stock-warning");
    stock.style.opacity=0;
}

function decreaseQuantity() {
    var inputElement = document.getElementById("quantity");
    var currentValue = parseInt(inputElement.value);
    if (currentValue > 1) {
        inputElement.value = currentValue - 1;
    }
    var stock=document.querySelector(".stock-warning");
    stock.style.opacity=0;
}
function creatToast(status,mess,icon,end_color){
    var newDiv= document.createElement("div");
    newDiv.classList.add("item",status);
    newDiv.innerHTML=`
        <div class="item-main">
            <i class="item-icon `+icon+`"></i>
            <span class="item-text">`+mess+`</span>
        </div>
        <div class="item-end `+end_color+`">
        </div>`

    document.querySelector(".notification").appendChild(newDiv);
    newDiv.classList.add("chuyendong")
  
    setTimeout(() => {
        newDiv.classList.add("hidden");
    }, 3000);
}

var btnMenu=document.querySelector(".header-logo-menu");
btnMenu.addEventListener('click',function(){
    var menuMobile= document.querySelector(".menu-mobile");
    if(menuMobile.style.display=="none"){
        menuMobile.style.display='block';
    }
    else{
        menuMobile.style.display='none';
    }
});

var btnXmenu=document.querySelector(".menu-mobile_title-icon");
btnXmenu.addEventListener('click',function(){
    var menuMobile= document.querySelector(".menu-mobile");
    menuMobile.style.display='none';
});