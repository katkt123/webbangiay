<?php
if (search) {
            search.addEventListener('keydown', function(e) {
                list_tag = document.querySelectorAll(".tagret-item");
                if (e.which == 13) {
                    e.stopPropagation(); //Ngăn chặn nổi bọt
                    var url =`index.php?danhmuc=products`+`&search=`+ search.value;
                    window.location.href = url;
                    // console.log(search.value);
                }
            });
        }
?>