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
            { text: "Explorar itens do museu 🡺", url: "items" },
            { text: "Contribuir com o museu 🡺", url: "items/create" },
        ]
    },
    {
        id: 3,
        text: "Nesta página contaremos um pouco mais sobre o nosso projeto e as entidades envolvidas na criação do E-museu.",
        choices: [
            { text: "Voltar para as opções", nextId: 2 }
        ]
    },
];
