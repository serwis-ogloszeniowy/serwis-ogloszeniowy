FROM ubuntu:14.04

ENV USER ftpuser
ENV PASS changeme

RUN apt-get update && \
    apt-get install -y vsftpd supervisor && \
    mkdir -p /var/run/vsftpd/empty

RUN apt-get install -y apache2

RUN mkdir -p /var/log/supervisor

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
ADD start.sh /usr/local/bin/start.sh
ADD vsftpd.conf /etc/vsftpd.conf

RUN mkdir /ftp

VOLUME ["/ftp"]

EXPOSE 20 21
EXPOSE 12020 12021 12022 12023 12024 12025

ENTRYPOINT ["/usr/local/bin/start.sh"]

CMD ["/etc/init.d/apache2", "-D", "FOREGROUND"]

CMD ["/usr/bin/supervisord"]
#CMD export USER=myuser
#CMD export PASS=qwerty
RUN export USER=myuser
RUN export PASS=qwerty
