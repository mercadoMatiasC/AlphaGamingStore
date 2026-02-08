document.addEventListener('submit', async function (e) {
    const form = e.target;

    if (!form.matches('form[data-idempotent]')) return;

    e.preventDefault();

    if (form.dataset.submitting === 'true') return;
    form.dataset.submitting = 'true';

    const uuid = crypto.randomUUID();

    const response = await fetch(form.action, {
        method: form.method || 'POST',
        headers: {
            'Idempotency-Key': uuid,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: new FormData(form),
    });

    if (response.redirected) {
        window.location.href = response.url;
        return;
    }

    if (!response.ok) {
        window.location.reload();
        return;
    }

    window.location.reload();
});