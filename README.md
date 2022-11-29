# Apresentação

Este projeto tem como objetivo a criação de um plugin de galeria de videos embedados do youtube sem perda da performance.

Ele não carrega a API e os vídeos da galeria no load da página. Ele realiza o carregamento no “primeiro clique”.


## Primeiro clique

Primeiro clique é quando o usuário clica em algum vídeo pela primeira vez após o loading da página.

Por isso que no arquivo assets/youtube_main.js existem controles de primeiro clique. Porque quando o usuário vai assistir o primeiro vídeo o plugin carrega tudo. A partir do segundo, é só rodar o vídeo.
