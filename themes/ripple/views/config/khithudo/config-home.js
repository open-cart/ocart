const configMenu = {
    "data": [
        {
            "name":"Trang chủ",
            "slug":"/"
        },
        {
            "name":"Sản phẩm",
            "slug":"#",
            "children":[
                {
                    "name":"Khí công nghiệp",
                    "slug":"/product-category/khi-cong-nghiep",
                },
                {
                    "name":"Khí đặc biệt",
                    "slug":"/product-category/khi-dac-biet",
                },
                {
                    "name":"Khí chuẩn",
                    "slug":"/product-category/khi-chuan",
                },
                {
                    "name":"Khí y tế",
                    "slug":"/product-category/khi-y-te",
                },
                {
                    "name":"Thiết bị ngành khí",
                    "slug":"/product-category/thiet-bi-nganh-khi",
                },
                {
                    "name":"Các sản phẩm - dịch vụ khác",
                    "slug":"/product-category/khac",
                }
            ]
        },
        {
            "name":"Tin tức",
            "slug":"#",
            "children":[
                {
                    "name":"Hoạt động của công ty",
                    "slug":"/post-category/hoat-dong-cua-cong-ty",
                },
                {
                    "name":"Kiến thức ngành khí",
                    "slug":"/post-category/kien-thuc-nganh-khi",
                    "children": [
                        {
                            "name":"Ứng dụng khí",
                            "slug":"/post-category/ung-dung-khi",
                        },
                        {
                            "name":"Các kiến thức khác",
                            "slug":"/post-category/cac-kien-thuc-khac",
                        }
                    ]
                }
            ]
        },
        {
            "name": "Liên hệ",
            "slug": "/contact.html"
        }
    ]
}

const configMenuFooter = {
    "data": [
        {
            "title": "Sản phẩm",
            "menu": [
                {
                    "name":"Khí công nghiệp",
                    "slug":"/product-category/khi-cong-nghiep",
                },
                {
                    "name":"Khí đặc biệt",
                    "slug":"/product-category/khi-dac-biet",
                },
                {
                    "name":"Khí chuẩn",
                    "slug":"/product-category/khi-chuan",
                },
                {
                    "name":"Khí y tế",
                    "slug":"/product-category/khi-y-te",
                },
                {
                    "name":"Thiết bị ngành khí",
                    "slug":"/product-category/thiet-bi-nganh-khi",
                },
                {
                    "name":"Các sản phẩm - dịch vụ khác",
                    "slug":"/product-category/khac",
                }
            ]
        },
        {
            "title": "Tin tức",
            "menu": [
                {
                    "name":"Hoạt động của công ty",
                    "slug":"/post-category/hoat-dong-cua-cong-ty",
                },
                {
                    "name":"Kiến thức ngành khí",
                    "slug":"/post-category/kien-thuc-nganh-khi",
                },
                {
                    "name":"Ứng dụng khí",
                    "slug":"/post-category/ung-dung-khi",
                },
                {
                    "name":"Các kiến thức khác",
                    "slug":"/post-category/cac-kien-thuc-khac",
                }
            ]
        },
        {
            "title": "Liên kết",
            "menu": [
                {
                    "name": "Giới thiệu",
                    "slug": "/about.html"
                },
                {
                    "name": "Liên hệ",
                    "slug": "/contact.html"
                },
                {
                    "name": "Facebook",
                    "slug": "https://www.facebook.com/Doanh-nghiệp-kh%C3%AD-Thủ-Đô-Xanh-110401501245965"
                },
                {
                    "name": "Zalo",
                    "slug": "https://zalo.me/0912110941 "
                },
            ]
        }
    ]
}

const configSections = {
    "name": "khithudo",
    "value": [
        "about",
        "feedback",
        "partner",
        "contact",
        "categories_product",
        "products_feture",
        "products_menu",
    ]
}

const configProductsMenu = {
    "data": [
        {
            "name" : "Phòng ngủ",
            "slug": "danh-muc-con-3",
            "id": "1",
            "children": [
                {
                    "name" : "Giường",
                    "slug": "giuong",
                },
                {
                    "name" : "Tủ quần áo",
                    "slug": "tu-quan-ao",
                }
            ]
        },
        {
            "name" : "Phòng khách",
            "slug": "danh-muc-con-3",
            "id": "2",
            "children": [
                {
                    "name" : "Bàn Ghế",
                    "slug": "ban-ghe",
                },
                {
                    "name" : "Kệ tivi",
                    "slug": "ke-ti-vi",
                }
            ]
        },
    ]
}

console.log(JSON.stringify(configProductsMenu))
