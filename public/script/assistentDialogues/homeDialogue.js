const dialogues = [
    {
        id: 1,
        text: "Olá, sou Ada, sua assistente virtual. Como posso te ajudar?",
        choices: [
            { text: "Disponibilizar opções", nextId: 2 },
        ]
    },
    {
        id: 2,
        text: "O que gostaria de saber?",
        choices: [
            { text: "Saber mais sobre a página atual", nextId: 3 },
            { text: "Explorar itens do museu 🡺", url: "items" },
            { text: "Contribuir com o museu 🡺", url: "items/create" },
            { text: "Saber mais sobre o museu 🡺", url: "about" },
        ]
    },
    {
        id: 3,
        text: "Nesta página te contamos um pouco sobre o nosso projeto de museu para itens eletrônicos. E na parte de baixo estão disponibilizados algumas opções de páginas para navegar. Dê uma olhada!",
        choices: [
            { text: "Voltar para as opções", nextId: 2 }
        ]
    },
];
