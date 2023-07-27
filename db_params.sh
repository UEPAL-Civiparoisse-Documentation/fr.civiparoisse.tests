#!/bin/bash
(
eval `cv --cwd=/app vars:show --out shell`
echo "cividbusername: ${CIVI_DB_USER}"
echo "cividbpassword: ${CIVI_DB_PASS}"
echo "cividbdatabase: ${CIVI_DB_NAME}"
echo "cividsn: ${CIVI_DB_DSN}"
echo "drupaldbusername: ${CMS_DB_USER}"
echo "drupaldbpassword: ${CMS_DB_PASS}"
echo "drupaldbname: ${CMS_DB_NAME}"
echo "drupaldsn: ${CMS_DB_DSN}"
)>db_params.yml
