-- Banco de dados
CREATE DATABASE IF NOT EXISTS sistema;
USE sistema;


-- Tabela de usuários
CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    foto VARCHAR(255)
);

ALTER TABLE usuario
ADD COLUMN IF NOT EXISTS nivel ENUM('admin','usuario') NOT NULL DEFAULT 'usuario';

-- Tabela de serviços
CREATE TABLE IF NOT EXISTS servico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    foto VARCHAR(255)
);

-- Tabela de avaliações
CREATE TABLE IF NOT EXISTS avaliacao (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome varchar(100) NOT NULL,
  estrelas int(11) NOT NULL,
  comentario text NOT NULL,
  id_servico INT NOT NULL,
  CONSTRAINT fk_servico FOREIGN KEY(id_servico) REFERENCES servico(id) 
);

CREATE TABLE IF NOT EXISTS produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    foto VARCHAR(255)
);

-- Tabela de contatos
CREATE TABLE IF NOT EXISTS contato (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mensagem TEXT NOT NULL,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 
INSERT INTO servico (titulo, descricao, foto) VALUES
('Café com Gatos', 'Desfrute de uma xícara de café ou chá enquanto interage com nossos gatos amigáveis em um ambiente acolhedor.', 'https://images.prismic.io/trustedhousesitters/73c75e56-9eaf-4eef-a7b2-2d782286c9a3_can+cats+have+coffee.jpg?auto=compress,format&rect=0,0,1920,800&w=1920&h=800'),
('Espaço de Leitura com Gatos', 'Relaxe em nosso espaço dedicado à leitura, cercado por gatos tranquilos, onde você pode ler seus livros favoritos enquanto os felinos se aconchegam ao seu lado, criando um ambiente sereno e acolhedor.', 'https://ca-times.brightspotcdn.com/dims4/default/08e12cc/2147483647/strip/true/crop/8192x5464+0+0/resize/2000x1334!/quality/75/?url=https%3A%2F%2Fcalifornia-times-brightspot.s3.amazonaws.com%2Faf%2Fb2%2F76e1d0054a948fcc01eb35650382%2F1519796-wk-cool-cat-collective-silent-reading-night-jey-03.jpg'),
('Adoção de Gatos', 'Conheça nossos gatos disponíveis para adoção e receba orientações sobre como levar um novo amigo para casa.', 'https://cdn.firespring.com/images/d70d75c2-06f9-408c-ab2e-999cfbbaa9e9.jpg'),
('Evento de Aniversário', 'Celebre aniversários ou eventos especiais com um pacote que inclui tempo com os gatos, lanches e decorações temáticas.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaFPYMppBkQDGNwL9ldFDL2AcweqvVhxa5Sg&s'),
('Alimentação e Cuidados', 'Assista ou participe de sessões educacionais sobre alimentação saudável e cuidados diários com os gatos.', 'https://www.liveabout.com/thmb/I2r_bjNvznT98AgHFm_uR2F_b4Y=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/girl-playing-with-cats-in-cat-cafe-1063781456-613a218c722a4c79ba869ab5bf2d0bd1.jpg'),
('Workshop de Comportamento Felino', 'Aprenda sobre o comportamento dos gatos em workshops interativos, com dicas de especialistas.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmcsgCr7Q7vAI2x8Mgkl9bN8OFNbuvwb8Lmg&s'),
('Merchandise Personalizado', 'Compre itens temáticos como camisetas, canecas e brinquedos inspirados nos nossos gatos.', 'https://mir-s3-cdn-cf.behance.net/project_modules/1400_webp/bcce4b200413161.6661c520d94b9.jpg');

INSERT INTO produto (nome, descricao, preco, foto) VALUES
('Latte Mia', 'Café cremoso com arte felina e sabor suave de leite vaporizado.', 18.00, 'https://media.istockphoto.com/id/1134371245/pt/foto/cute-cat-face-latte-art-coffee-in-white-cup-on-wooden-table-love-coffee-cute-neko-latte-art.jpg?s=170667a&w=0&k=20&c=fN9w05B3kiy1TxfkSAigt41vr3w5lUwJkdzi-HOIaBo='),
('Cappuccino Rose', 'Mistura delicada de café e espuma de leite com um toque floral irresistível.', 22.00, 'https://images.ctfassets.net/qfxflpv0atz9/4UVsJWUnEMghn0VrlE4Ml5/5410bd2cfb4d6d1d5dd1841451da6f97/cappuccino-em-casa-destaque.jpg'),
('Cookie Gatinho', 'Biscoito artesanal em formato de gatinho, crocante e cheio de doçura.', 9.00, 'https://i.pinimg.com/564x/e7/25/9d/e7259d762e48c9b9f1dc30564581db05.jpg'),
('Mocha Felino', 'Perfeita combinação de café expresso, chocolate e leite cremoso.', 20.00, 'https://assets.unileversolutions.com/recipes-v2/237868.jpg'),
('Brownie Mia', 'Brownie intenso com pedaços de chocolate e toque de cacau puro.', 12.00, 'https://recipesblob.oetker.com.br/assets/677216088b6540a0b110ca1d74479af6/1272x764/brownie-com-sorvete.webp'),
('Frapê Caramel Cat', 'Bebida gelada com calda de caramelo e chantilly, perfeita para refrescar.', 26.00, 'https://blog.finamac.com/wp-content/uploads/2019/10/309956-como-oferecer-os-melhores-sabores-de-milkshake-para-os-clientes.jpg'),
('Mini Tartlette', 'Tortinha doce e delicada, com base amanteigada e recheio cremoso.', 7.00, 'https://docesemimosgourmet.com.br/wp-content/uploads/2019/09/IMG_7949_Easy-Resize.com_.jpg'),
('Espresso Mia', 'Café expresso intenso e aromático, ideal para os amantes do sabor forte.', 10.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAq83mKxX81nHDhMixnJMKwLSQ729W63lPOQ&s'),
('Cheesecake Berry Paws', 'Cheesecake cremoso com calda de frutas vermelhas frescas.', 16.00, 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?auto=format&w=900&q=80'),
('Affogato Mia', 'Sorvete de baunilha mergulhado em expresso quente, uma combinação irresistível.', 22.00, 'https://static01.nyt.com/images/2021/08/15/magazine/affogato/affogato-threeByTwoLargeAt2X-v2.jpg'),
('Mousse Duo Gatinho', 'Mousse bicolor de chocolate e baunilha com textura leve e aveludada.', 11.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRvMXFTHAi9EQEulLKSDGKabwisF8FMF6FzJg&s'),
('Matcha Mia', 'Bebida cremosa à base de chá verde japonês com leite vaporizado.', 19.00, 'https://cdn.shopify.com/s/files/1/1456/8506/files/shutterstock_717825796_600x600.jpg?v=1717872256');