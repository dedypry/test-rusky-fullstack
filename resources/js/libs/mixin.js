import Swal from 'sweetalert2'
import moment from 'moment'

const notify = (msg, type = 'success') => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: toast => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        },
    })

    Toast.fire({
        icon: type,
        title: msg,
    })
}
const confirm = (callback, text = "You won't be able to revert this!", textButton = 'Yes, delete it!') => {
    Swal.fire({
        title: 'Are you sure?',
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: textButton,
    }).then(result => {
        if (result.isConfirmed) {
            // eslint-disable-next-line promise/no-callback-in-promise
            callback()
        }
    })
}

const formatDate = (date) => {
    if (!date) return "-";
    return moment(date).format("DD MMM YYYY HH:mm");
}
export {
    notify,
    confirm,
    formatDate
}
