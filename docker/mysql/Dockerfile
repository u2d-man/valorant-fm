FROM mysql:5.7

COPY ./docker/mysql/my.cnf /etc/mysql/conf.d/

# RUN apt-get update && apt-get install -y \
#   locales\
#   && apt-getclean\
#   && rm-rf/var/lib/apt/lists/*

# RUN sed -i -E 's/# (ja_JP.UTF-8)/\1/' /etc/locale.gen \
#   && locale-gen
ENV LANG ja_JP.UTF-8
CMD ["mysqld", "--character-set-server=utf8", "--collation-server=utf8_unicode_ci"]
