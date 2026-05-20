function mascaraRG(input) {
    let v = input.value.replace(/\D/g, '').slice(0, 9);

    if (v.length > 8) {
        v = v.replace(/^(\d{2})(\d{3})(\d{3})(\d)$/, '$1.$2.$3-$4');
    } else if (v.length > 5) {
        v = v.replace(/^(\d{2})(\d{3})(\d+)$/, '$1.$2.$3');
    } else if (v.length > 2) {
        v = v.replace(/^(\d{2})(\d+)$/, '$1.$2');
    }

    input.value = v;
}

function mascaraSalario(input) {
    let v = input.value.replace(/\D/g, '');

    if (v.length === 0) {
        input.value = '';
        return;
    }

    v = (parseInt(v, 10) / 100).toFixed(2);
    input.value = v
        .replace('.', ',')
        .replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function salarioParaFloat(valor) {
    return parseFloat(valor.replace(/\./g, '').replace(',', '.')) || 0;
}

document.addEventListener('DOMContentLoaded', function () {
    const rgInput = document.getElementById('rg');
    const salarioInput = document.getElementById('salario');
    const form = document.querySelector('form');

    if (rgInput) {
        rgInput.addEventListener('input', function () {
            mascaraRG(this);
        });
    }

    if (salarioInput) {
        salarioInput.setAttribute('type', 'text');
        salarioInput.addEventListener('input', function () {
            mascaraSalario(this);
        });
        if (form) {
            form.addEventListener('submit', function () {
                salarioInput.value = salarioParaFloat(salarioInput.value).toString();
            });
        }
    }
});