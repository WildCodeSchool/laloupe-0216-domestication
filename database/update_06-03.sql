/* Copie les relations personnes vers speakers */
INSERT INTO wp_postmeta
(post_id, meta_key, meta_value)
SELECT post_id, 'cr3ativconf_speakers', meta_value
FROM wp_postmeta
WHERE meta_key = 'cr3ativconf_persons';

/* renomme les clefs "persons" vers "coauthors" */
UPDATE wp_postmeta SET meta_key = 'cr3ativconf_coauthors'
WHERE meta_key = 'cr3ativconf_persons';

/* vide les relations dans les "coautheurs", qui sont faussement "speakers" */
UPDATE wp_postmeta SET meta_value = ''
WHERE meta_key = 'cr3ativconf_coauthors';
