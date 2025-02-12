# TODOs:
App
- Implement pagination.



## CSS RESPONSIVE DESIGN
// width >= 726px === min-width: 726px
// width <= 726px === max-width: 726px
/* Mobile-first approach (default styles for mobile) */

/* Small Phones (<= 480px) */
@media screen and (max-width: 480px) {
    body {
        font-size: 14px;
    }
}

/* Medium Phones (481px - 767px) */
@media screen and (min-width: 481px) and (max-width: 767px) {
    body {
        font-size: 16px;
    }
}

/* Tablets (768px - 1024px) */
@media screen and (min-width: 768px) and (max-width: 1024px) {
    body {
        font-size: 18px;
    }
}

/* Laptops (1025px - 1440px) */
@media screen and (min-width: 1025px) and (max-width: 1440px) {
    body {
        font-size: 20px;
    }
}

/* Desktops (1441px and above) */
@media screen and (min-width: 1441px) {
    body {
        font-size: 22px;
    }
}
