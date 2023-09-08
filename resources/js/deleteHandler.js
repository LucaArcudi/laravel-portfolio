const forms = document.querySelectorAll('.form-deleter');
forms.forEach(form => {
    form.addEventListener('click', function(event) {
        event.preventDefault();
        const projectTitle = form.getAttribute('id');
        const currentUrl = window.location.href;
        if (currentUrl === 'http://127.0.0.1:8000/admin/projects/trash') {
            if (confirm(`${projectTitle} will be permanently removed, are you sure?`)) this.submit();
        } else {
            if (confirm(`Move ${projectTitle} to trash?`)) this.submit();
        }
    })
})