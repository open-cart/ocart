

const listIcons = {
    upload: (props) => (
        <svg {...props} viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none"
             stroke-linecap="round" stroke-linejoin="round" className="css-i6dzq1"><path
            d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12"
                                                                                                                   y1="3"
                                                                                                                   x2="12"
                                                                                                                   y2="15"></line></svg>
    ),
    folder: (props) => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fad" data-icon="folder" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" className="svg-inline--fa fa-folder fa-w-16 fa-3x"><g
            className="fa-group"><path fill="currentColor"
                                       d="M464 128H272l-64-64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V176c0-26.51-21.49-48-48-48z"
                                       className="fa-secondary"></path><path fill="currentColor" d=""
                                                                             className="fa-primary"></path></g></svg>
    ),
    refresh: props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fas" data-icon="redo-alt" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
             className="svg-inline--fa fa-redo-alt fa-w-16 fa-3x">
            <path fill="currentColor"
                  d="M256.455 8c66.269.119 126.437 26.233 170.859 68.685l35.715-35.715C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.75c-30.864-28.899-70.801-44.907-113.23-45.273-92.398-.798-170.283 73.977-169.484 169.442C88.764 348.009 162.184 424 256 424c41.127 0 79.997-14.678 110.629-41.556 4.743-4.161 11.906-3.908 16.368.553l39.662 39.662c4.872 4.872 4.631 12.815-.482 17.433C378.202 479.813 319.926 504 256 504 119.034 504 8.001 392.967 8 256.002 7.999 119.193 119.646 7.755 256.455 8z"
                  className=""></path>
        </svg>
    ),
    filter: props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fas" data-icon="filter" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
             className="svg-inline--fa fa-filter fa-w-16 fa-3x">
            <path fill="currentColor"
                  d="M487.976 0H24.028C2.71 0-8.047 25.866 7.058 40.971L192 225.941V432c0 7.831 3.821 15.17 10.237 19.662l80 55.98C298.02 518.69 320 507.493 320 487.98V225.941l184.947-184.97C520.021 25.896 509.338 0 487.976 0z"
                  className=""></path>
        </svg>
    ),
    recycle: props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fas" data-icon="recycle" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
             className="svg-inline--fa fa-recycle fa-w-16 fa-3x">
            <path fill="currentColor"
                  d="M184.561 261.903c3.232 13.997-12.123 24.635-24.068 17.168l-40.736-25.455-50.867 81.402C55.606 356.273 70.96 384 96.012 384H148c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12H96.115c-75.334 0-121.302-83.048-81.408-146.88l50.822-81.388-40.725-25.448c-12.081-7.547-8.966-25.961 4.879-29.158l110.237-25.45c8.611-1.988 17.201 3.381 19.189 11.99l25.452 110.237zm98.561-182.915l41.289 66.076-40.74 25.457c-12.051 7.528-9 25.953 4.879 29.158l110.237 25.45c8.672 1.999 17.215-3.438 19.189-11.99l25.45-110.237c3.197-13.844-11.99-24.719-24.068-17.168l-40.687 25.424-41.263-66.082c-37.521-60.033-125.209-60.171-162.816 0l-17.963 28.766c-3.51 5.62-1.8 13.021 3.82 16.533l33.919 21.195c5.62 3.512 13.024 1.803 16.536-3.817l17.961-28.743c12.712-20.341 41.973-19.676 54.257-.022zM497.288 301.12l-27.515-44.065c-3.511-5.623-10.916-7.334-16.538-3.821l-33.861 21.159c-5.62 3.512-7.33 10.915-3.818 16.536l27.564 44.112c13.257 21.211-2.057 48.96-27.136 48.96H320V336.02c0-14.213-17.242-21.383-27.313-11.313l-80 79.981c-6.249 6.248-6.249 16.379 0 22.627l80 79.989C302.689 517.308 320 510.3 320 495.989V448h95.88c75.274 0 121.335-82.997 81.408-146.88z"
                  className=""></path>
        </svg>
    ),
    image: props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fas" data-icon="image" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" className="svg-inline--fa fa-image fa-w-16 fa-3x">
            <path fill="currentColor"
                  d="M464 448H48c-26.51 0-48-21.49-48-48V112c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48zM112 120c-30.928 0-56 25.072-56 56s25.072 56 56 56 56-25.072 56-56-25.072-56-56-56zM64 384h384V272l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L208 320l-55.515-55.515c-4.686-4.686-12.284-4.686-16.971 0L64 336v48z"
                  className=""></path>
        </svg>
    ),
    'file-video': props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-video" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
             className="svg-inline--fa fa-file-video fa-w-12 fa-3x">
            <path fill="currentColor"
                  d="M384 121.941V128H256V0h6.059c6.365 0 12.47 2.529 16.971 7.029l97.941 97.941A24.005 24.005 0 0 1 384 121.941zM224 136V0H24C10.745 0 0 10.745 0 24v464c0 13.255 10.745 24 24 24h336c13.255 0 24-10.745 24-24V160H248c-13.2 0-24-10.8-24-24zm96 144.016v111.963c0 21.445-25.943 31.998-40.971 16.971L224 353.941V392c0 13.255-10.745 24-24 24H88c-13.255 0-24-10.745-24-24V280c0-13.255 10.745-24 24-24h112c13.255 0 24 10.745 24 24v38.059l55.029-55.013c15.011-15.01 40.971-4.491 40.971 16.97z"
                  className=""></path>
        </svg>
    ),
    'file-alt': props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="far" data-icon="file-alt" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
             className="svg-inline--fa fa-file-alt fa-w-12 fa-3x">
            <path fill="currentColor"
                  d="M288 248v28c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-28c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm-12 72H108c-6.6 0-12 5.4-12 12v28c0 6.6 5.4 12 12 12h168c6.6 0 12-5.4 12-12v-28c0-6.6-5.4-12-12-12zm108-188.1V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V48C0 21.5 21.5 0 48 0h204.1C264.8 0 277 5.1 286 14.1L369.9 98c9 8.9 14.1 21.2 14.1 33.9zm-128-80V128h76.1L256 51.9zM336 464V176H232c-13.3 0-24-10.7-24-24V48H48v416h288z"
                  className=""></path>
        </svg>
    ),
    'sort-up': props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sort-amount-up" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
             className="svg-inline--fa fa-sort-amount-up fa-w-16 fa-3x">
            <path fill="currentColor"
                  d="M304 416h-64a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zM16 160h48v304a16 16 0 0 0 16 16h32a16 16 0 0 0 16-16V160h48c14.21 0 21.38-17.24 11.31-27.31l-80-96a16 16 0 0 0-22.62 0l-80 96C-5.35 142.74 1.77 160 16 160zm416 0H240a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h192a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm-64 128H240a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zM496 32H240a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h256a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"
                  className=""></path>
        </svg>
    ),
    'sort-down': props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sort-amount-down" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
             className="svg-inline--fa fa-sort-amount-down fa-w-16 fa-3x">
            <path fill="currentColor"
                  d="M304 416h-64a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm-128-64h-48V48a16 16 0 0 0-16-16H80a16 16 0 0 0-16 16v304H16c-14.19 0-21.37 17.24-11.29 27.31l80 96a16 16 0 0 0 22.62 0l80-96C197.35 369.26 190.22 352 176 352zm256-192H240a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h192a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm-64 128H240a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zM496 32H240a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h256a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"
                  className=""></path>
        </svg>
    ),
    'list': props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fad" data-icon="list-ul" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
             className="svg-inline--fa fa-list-ul fa-w-16 fa-3x">
            <g className="fa-group">
                <path fill="currentColor"
                      d="M496 384H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 160H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z"
                      className="fa-secondary"></path>
                <path fill="currentColor"
                      d="M48 48a48 48 0 1 0 48 48 48 48 0 0 0-48-48zm0 160a48 48 0 1 0 48 48 48 48 0 0 0-48-48zm0 160a48 48 0 1 0 48 48 48 48 0 0 0-48-48z"
                      className="fa-primary"></path>
            </g>
        </svg>
    ),
    gird: props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fad" data-icon="th-large" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
             className="svg-inline--fa fa-th-large fa-w-16 fa-3x">
            <g className="fa-group">
                <path fill="currentColor"
                      d="M488 272H296a24 24 0 0 0-24 24v160a24 24 0 0 0 24 24h192a24 24 0 0 0 24-24V296a24 24 0 0 0-24-24zm-272 0H24a24 24 0 0 0-24 24v160a24 24 0 0 0 24 24h192a24 24 0 0 0 24-24V296a24 24 0 0 0-24-24z"
                      className="fa-secondary"></path>
                <path fill="currentColor"
                      d="M488 32H296a24 24 0 0 0-24 24v160a24 24 0 0 0 24 24h192a24 24 0 0 0 24-24V56a24 24 0 0 0-24-24zm-272 0H24A24 24 0 0 0 0 56v160a24 24 0 0 0 24 24h192a24 24 0 0 0 24-24V56a24 24 0 0 0-24-24z"
                      className="fa-primary"></path>
            </g>
        </svg>
    ),
    dots: props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-v" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"
             className="svg-inline--fa fa-ellipsis-v fa-w-6 fa-3x">
            <path fill="currentColor"
                  d="M96 184c39.8 0 72 32.2 72 72s-32.2 72-72 72-72-32.2-72-72 32.2-72 72-72zM24 80c0 39.8 32.2 72 72 72s72-32.2 72-72S135.8 8 96 8 24 40.2 24 80zm0 352c0 39.8 32.2 72 72 72s72-32.2 72-72-32.2-72-72-72-72 32.2-72 72z"
                  className=""></path>
        </svg>
    ),
    search: props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="far" data-icon="search" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
             className="svg-inline--fa fa-search fa-w-16 fa-3x">
            <path fill="currentColor"
                  d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z"
                  className=""></path>
        </svg>
    ),
    globe: props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fas" data-icon="globe-asia" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"
             className="svg-inline--fa fa-globe-asia fa-w-16 fa-3x">
            <path fill="currentColor"
                  d="M248 8C111.03 8 0 119.03 0 256s111.03 248 248 248 248-111.03 248-248S384.97 8 248 8zm-11.34 240.23c-2.89 4.82-8.1 7.77-13.72 7.77h-.31c-4.24 0-8.31 1.69-11.31 4.69l-5.66 5.66c-3.12 3.12-3.12 8.19 0 11.31l5.66 5.66c3 3 4.69 7.07 4.69 11.31V304c0 8.84-7.16 16-16 16h-6.11c-6.06 0-11.6-3.42-14.31-8.85l-22.62-45.23c-2.44-4.88-8.95-5.94-12.81-2.08l-19.47 19.46c-3 3-7.07 4.69-11.31 4.69H50.81C49.12 277.55 48 266.92 48 256c0-110.28 89.72-200 200-200 21.51 0 42.2 3.51 61.63 9.82l-50.16 38.53c-5.11 3.41-4.63 11.06.86 13.81l10.83 5.41c5.42 2.71 8.84 8.25 8.84 14.31V216c0 4.42-3.58 8-8 8h-3.06c-3.03 0-5.8-1.71-7.15-4.42-1.56-3.12-5.96-3.29-7.76-.3l-17.37 28.95zM408 358.43c0 4.24-1.69 8.31-4.69 11.31l-9.57 9.57c-3 3-7.07 4.69-11.31 4.69h-15.16c-4.24 0-8.31-1.69-11.31-4.69l-13.01-13.01a26.767 26.767 0 0 0-25.42-7.04l-21.27 5.32c-1.27.32-2.57.48-3.88.48h-10.34c-4.24 0-8.31-1.69-11.31-4.69l-11.91-11.91a8.008 8.008 0 0 1-2.34-5.66v-10.2c0-3.27 1.99-6.21 5.03-7.43l39.34-15.74c1.98-.79 3.86-1.82 5.59-3.05l23.71-16.89a7.978 7.978 0 0 1 4.64-1.48h12.09c3.23 0 6.15 1.94 7.39 4.93l5.35 12.85a4 4 0 0 0 3.69 2.46h3.8c1.78 0 3.35-1.18 3.84-2.88l4.2-14.47c.5-1.71 2.06-2.88 3.84-2.88h6.06c2.21 0 4 1.79 4 4v12.93c0 2.12.84 4.16 2.34 5.66l11.91 11.91c3 3 4.69 7.07 4.69 11.31v24.6z"
                  className=""></path>
        </svg>
    ),
    copy: props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fal" data-icon="clone" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
             className="svg-inline--fa fa-clone fa-w-16 fa-fw fa-2x">
            <path fill="currentColor"
                  d="M464 0H144c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h320c26.51 0 48-21.49 48-48v-48h48c26.51 0 48-21.49 48-48V48c0-26.51-21.49-48-48-48zm-80 464c0 8.82-7.18 16-16 16H48c-8.82 0-16-7.18-16-16V144c0-8.82 7.18-16 16-16h48v240c0 26.51 21.49 48 48 48h240v48zm96-96c0 8.82-7.18 16-16 16H144c-8.82 0-16-7.18-16-16V48c0-8.82 7.18-16 16-16h320c8.82 0 16 7.18 16 16v320z"
                  className=""></path>
        </svg>
    ),
    'file-pdf': props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fad" data-icon="file-pdf" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
             className="svg-inline--fa fa-file-pdf fa-w-12 fa-3x">
            <g className="fa-group">
                <path fill="currentColor"
                      d="M86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zm93.8-218.9c-2.9 0-3 30.9 2 46.9 5.6-10 6.4-46.9-2-46.9zm80.2 142.1c37.1 15.8 42.8 9 42.8 9 4.1-2.7-2.5-11.9-42.8-9zm-79.9-48c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM272 128a16 16 0 0 1-16-16V0H24A23.94 23.94 0 0 0 0 23.88V488a23.94 23.94 0 0 0 23.88 24H360a23.94 23.94 0 0 0 24-23.88V128zm21.9 254.4c-16.9 0-42.3-7.7-64-19.5-24.9 4.1-53.2 14.7-79 23.2-25.4 43.8-43.2 61.8-61.1 61.8-5.5 0-15.9-3.1-21.5-10-19.1-23.5 27.4-54.1 54.5-68 .1 0 .1-.1.2-.1 12.1-21.2 29.2-58.2 40.8-85.8-8.5-32.9-13.1-58.7-8.1-77 5.4-19.7 43.1-22.6 47.8 6.8 5.4 17.6-1.7 45.7-6.2 64.2 9.4 24.8 22.7 41.6 42.7 53.8 19.3-2.5 59.7-6.4 73.6 7.2 11.5 11.4 9.5 43.4-19.7 43.4z"
                      className="fa-secondary"></path>
                <path fill="currentColor"
                      d="M377 105L279.1 7a24 24 0 0 0-17-7H256v112a16 16 0 0 0 16 16h112v-6.1a23.9 23.9 0 0 0-7-16.9zM240 331.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM86.1 428.1c5.8-15.7 28.2-33.9 34.9-40.2-21.7 34.8-34.9 41-34.9 40.2zm93.8-218.9c8.4 0 7.6 36.9 2 46.9-5-16-4.9-46.9-2-46.9zM151.8 366c11.1-19.4 20.7-42.5 28.4-62.7 9.6 17.4 21.8 31.2 34.5 40.8-23.9 4.7-44.6 14.9-62.9 21.9zm151.1-5.7s-5.7 6.8-42.8-9c40.3-2.9 46.9 6.3 42.8 9z"
                      className="fa-primary"></path>
            </g>
        </svg>
    ),
    zip: props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fad" data-icon="file-archive" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
             className="svg-inline--fa fa-file-archive fa-w-12 fa-3x">
            <g className="fa-group">
                <path fill="currentColor"
                      d="M272 128a16 16 0 0 1-16-16V0h-96v32h-32V0H24A23.94 23.94 0 0 0 0 23.88V488a23.94 23.94 0 0 0 23.88 24H360a23.94 23.94 0 0 0 24-23.88V128zM95.9 32h32v32h-32zm83.47 342.08a52.43 52.43 0 1 1-102.74-21L96 256v-32h32v-32H96v-32h32v-32H96V96h32V64h32v32h-32v32h32v32h-32v32h32v32h-32v32h22.33a12.08 12.08 0 0 1 11.8 9.7l17.3 87.7a52.54 52.54 0 0 1-.06 20.68z"
                      className="fa-secondary"></path>
                <path fill="currentColor"
                      d="M377 105L279.1 7a24 24 0 0 0-17-7H256v112a16 16 0 0 0 16 16h112v-6.1a23.9 23.9 0 0 0-7-16.9zM127.9 32h-32v32h32zM96 160v32h32v-32zM160 0h-32v32h32zM96 96v32h32V96zm83.43 257.4l-17.3-87.7a12.08 12.08 0 0 0-11.8-9.7H128v-32H96v32l-19.37 97.1a52.43 52.43 0 1 0 102.8.3zm-51.1 36.6c-17.9 0-32.5-12-32.5-27s14.5-27 32.4-27 32.5 12.1 32.5 27-14.5 27-32.4 27zM160 192h-32v32h32zm0-64h-32v32h32zm0-64h-32v32h32z"
                      className="fa-primary"></path>
            </g>
        </svg>
    ),
    excel: props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fal" data-icon="file-excel" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
             className="svg-inline--fa fa-file-excel fa-w-12 fa-fw fa-2x">
            <path fill="currentColor"
                  d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zm-22.6 22.7c2.1 2.1 3.5 4.6 4.2 7.4H256V32.5c2.8.7 5.3 2.1 7.4 4.2l83.9 83.9zM336 480H48c-8.8 0-16-7.2-16-16V48c0-8.8 7.2-16 16-16h176v104c0 13.3 10.7 24 24 24h104v304c0 8.8-7.2 16-16 16zM211.7 308l50.5-81.8c4.8-8-.9-18.2-10.3-18.2h-4.1c-4.1 0-7.9 2.1-10.1 5.5-31 48.5-36.4 53.5-45.7 74.5-17.2-32.2-8.4-16-45.8-74.5-2.2-3.4-6-5.5-10.1-5.5H132c-9.4 0-15.1 10.3-10.2 18.2L173 308l-59.1 89.5c-5.1 8 .6 18.5 10.1 18.5h3.5c4.1 0 7.9-2.1 10.1-5.5 37.2-58 45.3-62.5 54.4-82.5 31.5 56.7 44.3 67.2 54.4 82.6 2.2 3.4 6 5.4 10 5.4h3.6c9.5 0 15.2-10.4 10.1-18.4L211.7 308z"
                  className=""></path>
        </svg>
    ),
    'un-trash': props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fad" data-icon="trash-undo-alt" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
             className="svg-inline--fa fa-trash-undo-alt fa-w-14 fa-3x">
            <g className="fa-group">
                <path fill="currentColor"
                      d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96H32zm68.38-218.47l84-81.59c8.84-8.59 23.61-2.24 23.61 10.47v41.67c82.47.8 144 18.36 144 103.92 0 34.29-20.14 68.26-42.41 86-6.95 5.54-16.85-1.41-14.29-10.4 23.08-80.93-6.55-101.74-87.3-102.72v44.69c0 12.69-14.76 19.07-23.61 10.47l-84-81.59a14.69 14.69 0 0 1-.13-20.79l.13-.13z"
                      className="fa-secondary"></path>
                <path fill="currentColor"
                      d="M208 216.08v-41.67c0-12.71-14.77-19.06-23.61-10.47l-84 81.59a14.7 14.7 0 0 0-.15 20.79l.15.15 84 81.59c8.85 8.6 23.61 2.22 23.61-10.47V292.9c80.75 1 110.38 21.79 87.3 102.72-2.56 9 7.34 15.94 14.29 10.4C331.86 388.26 352 354.29 352 320c0-85.56-61.53-103.12-144-103.92zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.71 23.71 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"
                      className="fa-primary"></path>
            </g>
        </svg>
    ),
    trash: props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fad" data-icon="trash" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" className="svg-inline--fa fa-trash fa-w-14 fa-3x">
            <g className="fa-group">
                <path fill="currentColor"
                      d="M53.2 467L32 96h384l-21.2 371a48 48 0 0 1-47.9 45H101.1a48 48 0 0 1-47.9-45z"
                      className="fa-secondary"></path>
                <path fill="currentColor"
                      d="M0 80V48a16 16 0 0 1 16-16h120l9.4-18.7A23.72 23.72 0 0 1 166.8 0h114.3a24 24 0 0 1 21.5 13.3L312 32h120a16 16 0 0 1 16 16v32a16 16 0 0 1-16 16H16A16 16 0 0 1 0 80z"
                      className="fa-primary"></path>
            </g>
        </svg>
    ),
    'file-download': props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-download" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
             className="svg-inline--fa fa-file-download fa-w-12 fa-3x">
            <path fill="currentColor"
                  d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm76.45 211.36l-96.42 95.7c-6.65 6.61-17.39 6.61-24.04 0l-96.42-95.7C73.42 337.29 80.54 320 94.82 320H160v-80c0-8.84 7.16-16 16-16h32c8.84 0 16 7.16 16 16v80h65.18c14.28 0 21.4 17.29 11.27 27.36zM377 105L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9z"
                  className=""></path>
        </svg>
    ),
    edit: props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="fal" data-icon="edit" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" className="svg-inline--fa fa-edit fa-w-18 fa-3x">
            <path fill="currentColor"
                  d="M417.8 315.5l20-20c3.8-3.8 10.2-1.1 10.2 4.2V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h292.3c5.3 0 8 6.5 4.2 10.2l-20 20c-1.1 1.1-2.7 1.8-4.2 1.8H48c-8.8 0-16 7.2-16 16v352c0 8.8 7.2 16 16 16h352c8.8 0 16-7.2 16-16V319.7c0-1.6.6-3.1 1.8-4.2zm145.9-191.2L251.2 436.8l-99.9 11.1c-13.4 1.5-24.7-9.8-23.2-23.2l11.1-99.9L451.7 12.3c16.4-16.4 43-16.4 59.4 0l52.6 52.6c16.4 16.4 16.4 43 0 59.4zm-93.6 48.4L403.4 106 169.8 339.5l-8.3 75.1 75.1-8.3 233.5-233.6zm71-85.2l-52.6-52.6c-3.8-3.8-10.2-4-14.1 0L426 83.3l66.7 66.7 48.4-48.4c3.9-3.8 3.9-10.2 0-14.1z"
                  className=""></path>
        </svg>
    ),
    eye: props => (
        <svg {...props} aria-hidden="true" focusable="false" data-prefix="far" data-icon="eye" role="img"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" className="svg-inline--fa fa-eye fa-w-18 fa-3x">
            <path fill="currentColor"
                  d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"
                  className=""></path>
        </svg>
    )
}

export default function Icon({name, size = '18px'}) {
    const IconComponent = listIcons[name] || listIcons.upload;
    return <IconComponent style={{width: size, height: size}}/>;
}