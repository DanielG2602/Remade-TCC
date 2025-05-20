const dots = document.querySelectorAll('.dot');
const cardContainer = document.querySelector('.card-container');

// Exemplo: páginas simuladas
const pages = [
  [
    { nome: "Nome do Livro A", descricao: "Descrição A" },
    { nome: "Nome do Livro B", descricao: "Descrição B" },
    { nome: "Nome do Livro C", descricao: "Descrição C" }
  ],
  [
    { nome: "Livro D", descricao: "Descrição D" },
    { nome: "Livro E", descricao: "Descrição E" },
    { nome: "Livro F", descricao: "Descrição F" }
  ]
];

// Atualiza os cards com base na página
function renderPage(pageIndex) {
  const livros = pages[pageIndex];

  // Limpa os cards existentes
  cardContainer.innerHTML = '';

  livros.forEach(livro => {
    const card = document.createElement('div');
    card.className = 'card';
    card.innerHTML = `
      <div class="image-placeholder"></div>
      <div class="card-content">
        <h2>${livro.nome}</h2>
        <p>${livro.descricao}</p>
        <a href="#">Avaliar →</a>
      </div>
    `;
    cardContainer.appendChild(card);
  });

  // Atualiza bolinhas ativas
  dots.forEach(dot => dot.classList.remove('active'));
  dots[pageIndex].classList.add('active');
}

// Adiciona evento de clique nas bolinhas
dots.forEach((dot, index) => {
  dot.addEventListener('click', () => {
    renderPage(index);
  });
});

// Mostra a primeira página ao carregar
renderPage(0);
