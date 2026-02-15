console.log('idempotency loaded');

document.addEventListener('submit', async function (e) {
    console.log('submit event detected'); // 🔹 1

    const form = e.target;

    console.log('target:', form); // 🔹 2

    if (!form.matches('form[data-idempotent]')) {
        console.log('no coincide con data-idempotent'); // 🔹 3
        return;
    }

    console.log('form interceptado'); // 🔹 4

    e.preventDefault();

    if (form.dataset.submitting === 'true') {
        console.log('ya estaba enviando'); // 🔹 5
        return;
    }

    form.dataset.submitting = 'true';

    console.log('generando uuid'); // 🔹 6

    function generateUUID() {
        if (crypto.randomUUID) {
            return crypto.randomUUID();
        }

        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            const r = crypto.getRandomValues(new Uint8Array(1))[0] % 16;
            const v = c === 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }

    const uuid = generateUUID();

    console.log('haciendo fetch'); // 🔹 7

    const response = await fetch(form.action, {
        method: form.method || 'POST',
        headers: {
            'Idempotency-Key': uuid,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: new FormData(form),
    });

    console.log('response status:', response.status); // 🔹 8

    if (response.redirected) {
        console.log('redirect detectado'); // 🔹 9
        window.location.href = response.url;
        return;
    }

    if (!response.ok) {
        console.log('response no OK'); // 🔹 10
        window.location.reload();
        return;
    }

    console.log('reload final'); // 🔹 11
    window.location.reload();
});