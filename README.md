# Como começou
Este projeto visou, inicialmente, atender à [necessidade N.46 do PDTI 2014-2015 do IFSC](http://dtic.ifsc.edu.br/files/pdti-2014-2015-versao-1.pdf): uma [wiki](http://www.mediawiki.org/wiki/MediaWiki) institucional. Porém, outras aplicações Web se mostraram interessantes para complementar tal demanda:

* Compartilhamento de arquivos via HTTP: [ownCloud](https://owncloud.org).
* Blog: [Wordpress](https://wordpress.org).
* Moodle: [Moodle](https://moodle.org).
* Controle de versão distribuído: [GitLab](https://about.gitlab.com).

# Onde estou
Atualmente, a implementação conta com 3 servidores (máquinas virtuais ou físicas) para prover os serviços Web. O primeiro servidor, denominado `puppet`, é, como o nome diz, o servidor de configuração automatizada utilizando [Puppet](https://puppetlabs.com) com [git](https://git-scm.com). Além disso, há ainda a [centralização de *logs*](https://tools.ietf.org/html/rfc5424) e [hora certa](https://tools.ietf.org/html/rfc5905) em rede.

Os outros dois servidores, aqui chamados de `web0` e `web1`, são equivalentes entre si e rodam todas as aplicações Web, seja conteúdo estático ou dinâmico. Essas, assim como `puppet`, podem ser replicadas para outras *n* instâncias para atender mais clientes.

Para manter independência de virtualizador, foram escolhidas duas implementações para ganratir alta disponibilidade:

- Sistema de arquivos distribuído mestre-mestre: [GlusterFS](http://www.gluster.org).
- Banco de dados distribuído ativo-ativo e mestre-mestre: [Galera MySQL](http://galeracluster.com).

# Pré-instalação
Antes de aplicar a configuração via Puppet nos servidores, é preciso preparar o cenário. No meu caso, utilizei a plataforma [OpenStack](https://www.openstack.org/).

1. Cada servidor deve possuir, de preferência, duas interfaces de rede. A externa para controle remoto (SSH) e Web (HTTP/HTTPS). No meu cenário, eu utilizei a faixa 10.0.0.0/24 para a rede interna e 192.168.1.0/24 para rede externa, ambas via DHCP.
```
cat > /etc/network/interfaces <<FIM
auto lo
iface lo inet loopback
auto eth0
iface eth0 inet dhcp
auto eth1
iface eth1 inet dhcp
FIM
ifup -a
```
2. Pode-se ver, no comando abaixo, os IPs atribuídos dinamicamente a cada interface dos servidores após a execução do comando `ifup -a`. Preferi a simplicidade do arquivo `/etc/hosts` ao DNS (dado o reduzido tamanho do cenário):
```
cat >> /etc/hosts <<FIM
10.0.0.135 puppet syslog
10.0.0.136 web0
10.0.0.137 web1 mysql
192.168.1.158 puppet-ext
192.168.1.159 web0-ext
192.168.1.160 web1-ext
FIM
```
3. Em seguida, foi instalado o agente Puppet em cada servidor e colocado em espera:
```
aptitude update
aptitude -y safe-upgrade
aptitude install -y puppet
puppet agent --disable
```
4. Em `puppet`, foi instalado o servidor Puppet e integrado ao git para controle de versão da configuração automatizada:
```
aptitude install -y puppetmaster git
git clone https://github.com/boidacarapreta/wiki-ifsc.git /etc/wiki-ifsc
service puppet stop
service puppetmaster stop
rm -rf /etc/puppet
ln -s /etc/wiki-ifsc/puppet /etc/puppet
service puppetmaster restart
service puppet restart
```
5. Somente depois os agentes foram ativados. Em `web0` e `web1`:
```
puppet agent --enable
puppet agent --test
```
6. E em `puppet` o mesmo, além da validação do certificados de `web0` e `web1`:
```
puppet agent --enable
puppet cert sign web0.openstacklocal
puppet cert sign web1.openstacklocal
```
A partir deste ponto, serão necessárias algumas rodadas de execução nos agentes para instalar as dependências e iniciar todos os serviços, principalmente os serviços ligados a Web com [Docker](https://www.docker.com).

#Para onde vou
Próximos passos:

- GitLab.
- Wordpress.
- Moodle.
