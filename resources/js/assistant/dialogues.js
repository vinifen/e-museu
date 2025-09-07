// Diálogos para diferentes páginas
export const dialogues = {
    home: [
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
                { text: "Explorar itens do museu >", url: "items" },
                { text: "Contribuir com o museu >", url: "items/create" },
                { text: "Saber mais sobre o museu >", url: "about" },
                { text: "Entrar em contato com o museu >", nextId: 4 },
            ]
        },
        {
            id: 3,
            text: "Nesta página te contamos um pouco sobre o nosso projeto de museu para itens eletrônicos. E na parte de baixo estão disponibilizados algumas opções de páginas para navegar. Dê uma olhada!",
            choices: [
                { text: "Voltar para as opções", nextId: 2 }
            ]
        },
        {
            id: 4,
            text: "Caso tenha alguma dúvida ou outros assuntos a tratar conosco, envie um email para emuseuvirtual@gmail.com.",
            choices: [
                { text: "Voltar para as opções", nextId: 2 }
            ]
        }
    ],
    
    about: [
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
                { text: "Explorar itens do museu >", url: "items" },
                { text: "Contribuir com o museu >", url: "items/create" },
                { text: "Voltar para a página inicial >", url: "/" },
                { text: "Entrar em contato com o museu >", nextId: 4 },
            ]
        },
        {
            id: 3,
            text: "Esta página conta a história do projeto E-museu, desde sua criação até os dias atuais. Aqui você encontra informações sobre os objetivos do museu e como contribuir.",
            choices: [
                { text: "Voltar para as opções", nextId: 2 }
            ]
        },
        {
            id: 4,
            text: "Caso tenha alguma dúvida ou outros assuntos a tratar conosco, envie um email para emuseuvirtual@gmail.com.",
            choices: [
                { text: "Voltar para as opções", nextId: 2 }
            ]
        }
    ],
    
    items: [
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
                { text: "Como usar os filtros", nextId: 4 },
                { text: "Contribuir com o museu >", url: "items/create" },
                { text: "Voltar para a página inicial >", url: "/" },
                { text: "Entrar em contato com o museu >", nextId: 5 },
            ]
        },
        {
            id: 3,
            text: "Nesta página você pode explorar todos os itens disponíveis no museu. Use os filtros para encontrar itens específicos por categoria, seção ou etiquetas.",
            choices: [
                { text: "Voltar para as opções", nextId: 2 }
            ]
        },
        {
            id: 4,
            text: "Use os filtros na lateral esquerda para refinar sua busca. Você pode filtrar por categorias, seções e etiquetas. Também pode usar a barra de pesquisa para buscar por nome.",
            choices: [
                { text: "Voltar para as opções", nextId: 2 }
            ]
        },
        {
            id: 5,
            text: "Caso tenha alguma dúvida ou outros assuntos a tratar conosco, envie um email para emuseuvirtual@gmail.com.",
            choices: [
                { text: "Voltar para as opções", nextId: 2 }
            ]
        }
    ],

    create: [
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
                { text: "Como contribuir com um item", nextId: 3 },
                { text: "Que tipo de informações devo fornecer", nextId: 4 },
                { text: "Explorar itens do museu >", url: "items" },
                { text: "Voltar para a página inicial >", url: "/" },
                { text: "Entrar em contato com o museu >", nextId: 5 },
            ]
        },
        {
            id: 3,
            text: "Para contribuir, preencha o formulário com as informações do item eletrônico. Inclua fotos, descrição detalhada e selecione as categorias apropriadas.",
            choices: [
                { text: "Voltar para as opções", nextId: 2 }
            ]
        },
        {
            id: 4,
            text: "Forneça nome, descrição, ano de fabricação, proprietário, seção, categoria e etiquetas. Quanto mais informações, melhor para outros visitantes!",
            choices: [
                { text: "Voltar para as opções", nextId: 2 }
            ]
        },
        {
            id: 5,
            text: "Caso tenha alguma dúvida ou outros assuntos a tratar conosco, envie um email para emuseuvirtual@gmail.com.",
            choices: [
                { text: "Voltar para as opções", nextId: 2 }
            ]
        }
    ],

    show: [
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
                { text: "Sobre este item", nextId: 3 },
                { text: "Como navegar pela timeline", nextId: 4 },
                { text: "Explorar mais itens >", url: "items" },
                { text: "Contribuir com o museu >", url: "items/create" },
                { text: "Entrar em contato com o museu >", nextId: 5 },
            ]
        },
        {
            id: 3,
            text: "Esta página mostra todos os detalhes do item selecionado: descrição, imagens, componentes e informações técnicas. Explore as diferentes seções!",
            choices: [
                { text: "Voltar para as opções", nextId: 2 }
            ]
        },
        {
            id: 4,
            text: "A timeline mostra a evolução histórica do item. Use as setas para navegar entre os diferentes períodos e eventos importantes.",
            choices: [
                { text: "Voltar para as opções", nextId: 2 }
            ]
        },
        {
            id: 5,
            text: "Caso tenha alguma dúvida ou outros assuntos a tratar conosco, envie um email para emuseuvirtual@gmail.com.",
            choices: [
                { text: "Voltar para as opções", nextId: 2 }
            ]
        }
    ]
};

// Detecta automaticamente qual página está sendo exibida
export function getCurrentPageDialogues() {
    const path = window.location.pathname;
    
    if (path === '/' || path === '/home') {
        return dialogues.home;
    } else if (path.includes('/about')) {
        return dialogues.about;
    } else if (path.includes('/items/create')) {
        return dialogues.create;
    } else if (path.includes('/items/') && path.split('/').length === 3) {
        return dialogues.show;
    } else if (path.includes('/items')) {
        return dialogues.items;
    }
    
    // Fallback para página padrão
    return dialogues.home;
}
