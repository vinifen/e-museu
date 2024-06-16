const dialogues = [
    {
        id: 1,
        text: "Olá, sou Assistente, sua assistente virtual. Como posso te ajudar?",
        choices: [
            { text: "Disponibilizar opções", nextId: 2 },
        ]
    },
    {
        id: 2,
        text: "O que gostaria de saber?",
        choices: [
            { text: "Saber mais sobre a página atual", nextId: 3 },
            { text: "Ir para a página inicial do museu 🡺", url: "/" },
            { text: "Contribuir com o museu? 🡺", url: "/items/create" },
            { text: "Saber mais sobre o museu 🡺", url: "/about" },
        ]
    },
    {
        id: 3,
        text: "Esta é a página em que encontrará todos os itens disponíveis no nosso museu. Com a ajuda do sistema de busca, filtragem por etiquetas e organização por categoria, poderá encontrar todo tipo de item com bastante facilidade. Selecione um item para mais detalhes especifícos!",
        choices: [
            { text: "Organização por categorias", nextId: 4 },
            { text: "Sistema de busca", nextId: 5 },
            { text: "Filtragem por etiquetas", nextId: 6 },
            { text: "Voltar para as opções", nextId: 2 },
        ]
    },
    {
        id: 4,
        text: "Os itens do nosso museu são organizados por categoria. Ao selecionar uma categoria, na parte superior da página, você estará fazendo uma busca por todos os itens pertencentes a categoria escolhida.",
        choices: [
            { text: "Sistema de busca", nextId: 5 },
            { text: "Filtragem por etiquetas", nextId: 6 },
            { text: "Voltar para as opções", nextId: 2 },
        ]
    },
    {
        id: 5,
        text: "A barra de busca se localiza na parte superior da página. Lá, você pode pesquisar algum item pelo nome. Se deseja uma pesquisa mais minunciosa, selecione uma categoria, logo a direita da barra de pesquisa, para assim então, buscar por um item dentro da categoria escolhida.",
        choices: [
            { text: "Organização por categorias", nextId: 4 },
            { text: "Filtragem por etiquetas", nextId: 6 },
            { text: "Voltar para as opções", nextId: 2 },
        ]
    },
    {
        id: 6,
        text: "Além das categorias, alguns itens também recebem uma ou mais etiquetas, que têm o propósito de organizar com mais precisão os itens do nosso museu. À esquerda do conteúdo central da página, ou em um botão flutuante no canto inferior esquerdo se estiver usando um aparelho mobile, você econtrará as opções de filtragem por etiqueta, ordenação por data e ordem alfabética. Com este sistema, você poderá filtrar itens por marca, série, e muito mais!",
        choices: [
            { text: "Organização por categorias", nextId: 4 },
            { text: "Sistema de busca", nextId: 5 },
            { text: "Voltar para as opções", nextId: 2 },
        ]
    },

];
