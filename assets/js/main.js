(function () {
    "use strict";

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    }

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        if (all) {
            select(el, all).forEach(e => e.addEventListener(type, listener))
        } else {
            select(el, all).addEventListener(type, listener)
        }
    }

    /**
     * Easy on scroll event listener
     */
    const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener)
    }

    /**
     * Sidebar toggle
     */
    if (select('.toggle-sidebar-btn')) {
        on('click', '.toggle-sidebar-btn', function (e) {
            select('.toggle-sidebar-btn').classList.toggle('toggle-position')
            select('body').classList.toggle('toggle-sidebar')
        })
    }

    if (select('#sidebarCloseBtn')) {
        on('click', '#sidebarCloseBtn', function (e) {
            select('body').classList.toggle('toggle-sidebar')
        })
    }

    /**
     * Search bar toggle
     */
    if (select('.search-bar-toggle')) {
        on('click', '.search-bar-toggle', function (e) {
            select('.search-bar').classList.toggle('search-bar-show')
        })
    }

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select('#navbar .scrollto', true)
    const navbarlinksActive = () => {
        let position = window.scrollY + 200
        navbarlinks.forEach(navbarlink => {
            if (!navbarlink.hash) return
            let section = select(navbarlink.hash)
            if (!section) return
            if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                navbarlink.classList.add('active')
            } else {
                navbarlink.classList.remove('active')
            }
        })
    }
    window.addEventListener('load', navbarlinksActive)
    onscroll(document, navbarlinksActive)

    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     */
    let selectHeader = select('#header')
    if (selectHeader) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                selectHeader.classList.add('header-scrolled')
            } else {
                selectHeader.classList.remove('header-scrolled')
            }
        }
        window.addEventListener('load', headerScrolled)
        onscroll(document, headerScrolled)
    }

    /**
     * Back to top button
     */
    let backtotop = select('.back-to-top')
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add('active')
            } else {
                backtotop.classList.remove('active')
            }
        }
        window.addEventListener('load', toggleBacktotop)
        onscroll(document, toggleBacktotop)
    }

    /**
     * Initiate tooltips
     */
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    /**
     * Initiate quill editors
     */
    if (select('.quill-editor-default')) {
        new Quill('.quill-editor-default', {
            theme: 'snow'
        });
    }

    if (select('.quill-editor-bubble')) {
        new Quill('.quill-editor-bubble', {
            theme: 'bubble'
        });
    }

    if (select('.quill-editor-full')) {
        new Quill(".quill-editor-full", {
            modules: {
                toolbar: [
                    [{
                        font: []
                    }, {
                        size: []
                    }],
                    ["bold", "italic", "underline", "strike"],
                    [{
                        color: []
                    },
                        {
                            background: []
                        }
                    ],
                    [{
                        script: "super"
                    },
                        {
                            script: "sub"
                        }
                    ],
                    [{
                        list: "ordered"
                    },
                        {
                            list: "bullet"
                        },
                        {
                            indent: "-1"
                        },
                        {
                            indent: "+1"
                        }
                    ],
                    ["direction", {
                        align: []
                    }],
                    ["link", "image", "video"],
                    ["clean"]
                ]
            },
            theme: "snow"
        });
    }

    /**
     * Initiate Bootstrap validation check
     */
    var needsValidation = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(needsValidation)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })

    /**
     * Initiate Datatables
     */
    const datatables = select('.datatable', true)
    datatables.forEach(datatable => {
        new simpleDatatables.DataTable(datatable);
    })

    /**
     * Autoresize echart charts
     */
    const mainContainer = select('#main');
    if (mainContainer) {
        setTimeout(() => {
            new ResizeObserver(function () {
                select('.echart', true).forEach(getEchart => {
                    echarts.getInstanceByDom(getEchart).resize();
                })
            }).observe(mainContainer);
        }, 200);
    }

})();

/**
 * Page Restricted By Admin Access
 */

let token = localStorage.getItem('token') || null
if (token) {
    let decodedToken = JSON.parse(atob(token.split('.')[1]));

    function pageRestricted(page) {

        if (decodedToken.data.role === 'manage-admin') {
            // let access=['Category', 'News','News Approval', 'Video','Add Admin',' Manage Admin', 'Add User', 'Manage User', 'Comments', 'Reports', 'Advertisement', 'Notifications','Settings'];
            let access = JSON.parse(decodedToken.data.access)

            if (!access.includes(page)) {
                // window.location.href = `./${pageName}.php
                window.location.href = '../index.php'
                // $(`#${id}`).css("background", "green")

            }
        } else if (decodedToken.data.role === 'superAdmin') {
            return false
        } else {
            window.location.href = './index.php'
        }
    }
}

function clearError(input) {
    $('#' + input.id).removeClass('is-invalid');
    $('#' + input.id + '_label').removeClass('text-danger');
    $('#' + input.id + '_icon').removeClass('text-danger');
    $('#' + input.id + '_icon_border').removeClass('field-error');
    $('#' + input.id + '_error').html('');
}

/**
 * Global Submit Form (AJAX)
 */
function formSubmit(type, btn, form, url, headers = null) {
    let decodedToken = JSON.parse(atob(token.split('.')[1]));

    if (decodedToken.data.email === 'demoadmin@news.com'){
        toastr.error("You Are Demo User")
    }else {
        let form_data = JSON.stringify(form.serializeJSON());

        $.ajax({
            type: type,
            url: url,
            data: form_data,
            headers: headers,
            beforeSend: function () {
                $('#' + btn).prop('disabled', true);
                $('#preloader').removeClass('d-none');
            },
            success: function (response) {
                if (response && response.status && response.status === 'success' && response.data) {
                    toastr.success(response.data);
                    form[0].reset();

                    setTimeout((function () {
                        window.location.reload();
                    }), 500);
                } else {
                    toastr.error('Something went wrong', 'Please try again after sometime.')

                }
            },
            error: function (xhr, resp, text) {

                // on error, tell the failed
                if (xhr && xhr.responseText) {
                    let response = JSON.parse(xhr.responseText);
                    $('#preloader').addClass('d-none');
                    if (response.status && response.status === 'validate_error') {

                        $.each(response.data, function (index, message) {
                            if (message.field && message.field !== 'global') {
                                $('#' + message.field).addClass('is-invalid');
                                $('#' + message.field + '_label').addClass('text-danger');
                                $('#' + message.field + '_error').html(message.error);
                            } else if (message.error) {
                                toastr.error(message.error);
                            } else {
                                // toastr.error('Something went wrong', 'Please try again after sometime.');
                                console.log("err 1")
                            }
                        });
                    } else {
                        // toastr.error('Something went wrong', 'Please try again after sometime.');
                        console.log("err 2")
                    }
                } else {
                    // toastr.error('Something went wrong', 'Please try again after sometime.');
                    console.log("err 3")
                }
            },
            complete: function (xhr, status) {
                $('#' + btn).prop('disabled', false);
                $('#preloader').addClass();
            }
        });
    }


}

/**
 * GET Single Data for Edit
 */
function getEditData(url, dropzone = null) {
    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {

            // console.log(response)
            if (response && response.status && response.status === 'success') {

                Object.entries(response.data[0]).forEach((item) => {

                    $('#' + item[0]).val(item[1]);

                    if (item[0] === 'image') {
                        if (dropzone) {
                            let mockFile = {name: 'image', size: 600,};
                            // let imageUrls = item[1].split('/')
                            let imageUrl = item[1]

                            // imageUrls.forEach((item, i) => {
                            //     if (i > 0) imageUrl += '/' + item
                            // })

                            // console.log('imgurl', imageUrl)

                            dropzone.displayExistingFile(mockFile, imageUrl);

                            $('#logo').val(imageUrl)
                        }

                    }


                    if (item[0] === 'description') {
                        descriptionEditor.setData(item[1])
                    } else if (item[0] === 'privacy_policy') {
                        privacyEditor.setData(item[1])
                    } else if (item[0] === 'cookies_policy') {
                        cookiesEditor.setData(item[1])
                    } else if (item[0] === 'terms_policy') {
                        termsEditor.setData(item[1])
                    }

                    if (item[0] === 'access' && item[1] !== null) {
                        item[1].forEach(value => {
                            $(`input[name='access[]'][value='${value}']`).attr('checked', true)
                        })
                    }

                    if (item[0] === 'role' && item[1] === 'superAdmin') {
                        $('#accessControl').hide()
                    }

                    if (item[0] === 'host' || item[0] === 'api_key' || item[0] === 'copyright') {
                        if(item[1] === '' || item[1] === null){

                            $('#submit-button').text('Create')
                        }else{
                            $('#submit-button').text('Update')
                        }
                    }

                   

                    // if (item[0] === 'copyright') {

                    //     if(item[1] === '' || item[1] === null){
      
                    //         $('#submit-button').text('Create')
                    //     }else{
                    //         $('#submit-button').text('Update')
                    //     }

                       
                    // }


                })

            } else {
                toastr.error('Something went wrong', 'Please try again after sometime.')
            }
        },
        error: function (xhr, resp, text) {
            console.log(xhr, resp)
        }
    });
}


function generateTable(id, headers, data, actions = [], status = null) {
    let container = document.getElementById(id)

    container.innerHTML = "";

    data.forEach(function (item) {
        let tableRow = document.createElement('tr')

        headers.forEach((header) => {
            Object.keys(item).forEach((key) => {

                if (key === header.field) {
                    let tableData = document.createElement('td')

                    if (key === 'image') {
                        if (item[key] !== null) {

                            let imageUrls = item[key].split('/')
                            let imageUrl = ''
                            imageUrls.forEach((item, i) => {
                                if (i > 0) imageUrl += '/' + item
                            })

                            let imageTag = document.createElement('img')
                            imageTag.setAttribute('src', imageUrl)
                            imageTag.setAttribute('style', "width: 60px; height: 60px;")
                            tableData.appendChild(imageTag)
                        } else {
                            let imageTag = document.createElement('img')
                            imageTag.setAttribute('src', window.origin + '/assets/img/default.png')
                            imageTag.setAttribute('style', "width: 60px; height: 60px; border: 1px solid gray; object-fit: contain; ")
                            tableData.appendChild(imageTag)
                        }
                    } else {

                        if (key === 'status') {

                            let div = document.createElement('div')
                            div.setAttribute('class', 'form-check form-switch')

                            let label = document.createElement('label')
                            label.setAttribute('class', 'switch')
                            div.appendChild(label)

                            let input = document.createElement("input")
                            input.setAttribute("type", "checkbox")
                            input.setAttribute("data-id", item.id)
                            input.setAttribute("id", 'enableStatus'+item.id)



                            if (item.status === 'Active'){
                                input.setAttribute("checked", "true")
                            }

                            label.appendChild(input)

                            let div2 = document.createElement('div')
                            div2.setAttribute('class', 'slider round')
                            label.appendChild(div2)


                            if (status && Object.keys(status).length > 0) {

                                input.addEventListener('change', function () {
                                    let id = 'enableStatus'+item.id

                                    let url = status.url.replace(':id', item['id'])
                                    statusHandler(id, url);
                                    // console.log("hello click")
                                })
                            }


                            tableData.appendChild(div)
                        } else {
                            tableData.textContent = item[key]
                        }
                    }


                    tableRow.appendChild(tableData)
                }
            })

            if (header.field === 'action' && actions.length) {
                let tableData = document.createElement('td')

                actions.forEach((actionItem) => {
                    let actionBtn = document.createElement('button')
                    actionBtn.textContent = actionItem.label

                    if (actionItem.label.toLowerCase() === 'edit') {
                        actionBtn.setAttribute('class', 'btn btn-outline-secondary me-1 sm-btn')

                        actionBtn.addEventListener('click', function () {
                            window.location.href = actionItem.url.replace(':id', item.id)

                        })
                    } else if (actionItem.label.toLowerCase() === 'delete') {
                        actionBtn.setAttribute('class', 'btn btn-outline-secondary sm-btn')

                        actionBtn.addEventListener('click', function () {

                                deleteHandler(actionItem.url.replace(':id', item.id))

                        })
                    }

                    tableData.appendChild(actionBtn)
                })


                tableRow.appendChild(tableData)
            }
        })


        container.appendChild(tableRow)
    })
}


function getAllData(url, id, headers, actions = [], status = null) {
    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {

            if (response && response.status && response.status === 'success') {
                let data = response.data

                generateTable(id, headers, data, actions, status)
            } else {
                toastr.error('Something went wrong', 'Please try again after sometime.')
            }
        },
        error: function (xhr, resp, text) {
            console.log(xhr, resp)
        }
    });
}


/**
 * Uploads image
 */
function uploads(id, hiddenId) {
    let data = null;
    let image = new Dropzone("#" + id, {
        url: window.origin + "/api/v1/uploads.php",
        method: "post",
        uploadMultiple: false,
        // parallelUploads: 1,

        createImageThumbnails: true,
        paramName: "file",
        clickable: true,
        // addRemoveLinks: true,


        init: function () {
            this.on('addedfile', function (file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
        },
        success: function (file, res) {
            console.log('dropzone', file, res)

            let defaultExistFile = $('.dz-preview.dz-complete.dz-image-preview')

            if (defaultExistFile) {
                defaultExistFile.remove()
            }

            $('#' + hiddenId).val(res.data)
            data = res.data;

        },
    });

    return image;
}


//delete function
function deleteHandler(url) {

    let decodedToken = JSON.parse(atob(token.split('.')[1]));

    if (decodedToken.data.email === 'demoadmin@news.com'){
        toastr.error("You Are Demo User")
    }else{
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: "json",
                    success: function (res) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        setInterval(function () {
                            location.reload();
                        }, 1000)

                    },
                    error: function (xhr, resp, text) {
                        console.log(xhr);
                    },
                });


            }
        })
    }
}


//enable/disable
function statusHandler(status, url) {

    let decodedToken = JSON.parse(atob(token.split('.')[1]));

    if (decodedToken.data.email === 'demoadmin@news.com'){
        toastr.error("You Are Demo User")
    }else {
        let properties;
        if ($('#' + status).prop('checked')) {
            properties = 'Active';
        } else {
            properties = 'Inactive';
        }

        let id = $('#' + status).data('id');

        $('#preloader').removeClass('d-none');

        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: JSON.stringify({
                id: id,
                status: properties,
            }),
            success: function (res) {
                if (res.status === "success") {
                    $('#preloader').addClass('d-none');
                    toastr.success(res.success_message)
                    setTimeout((function () {
                        window.location.reload();
                    }), 500);
                }
            },
            error: function (err) {
                $('#preloader').addClass('d-none');
                console.log(err)
            }
        });
    }

}


function getCountryLanguage(url, list_id) {
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',

        success: function (res) {
            if (res.status === 'success') {
                res.data.forEach((item) => {
                    $('#' + list_id).append(`
                            <option value="${item.id}">${item.name}</option>
                    `)
                })
            }
        },
        error: function (err) {
            console.log(err);
        }
    })
}