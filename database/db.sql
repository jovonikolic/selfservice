CREATE TABLE `cps`
(
    `id`                  int(11) NOT NULL,
    `label`               varchar(255) DEFAULT NULL COMMENT 'Name of cp',
    `user_id`             int(11)      DEFAULT NULL,
    `country_id`          int(11)      DEFAULT NULL,
    `active`              bit(1)       DEFAULT NULL,
    `public_display_name` varchar(255) DEFAULT NULL,
    `geo_long`            varchar(255) DEFAULT NULL,
    `geo_lat`             varchar(255) DEFAULT NULL,
    `street`              varchar(255) DEFAULT NULL,
    `zip`                 varchar(255) DEFAULT NULL,
    `city`                varchar(255) DEFAULT NULL,
    `serialnumber`        varchar(255) DEFAULT NULL,
    `firmwareversion`     varchar(255) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='charge point table';


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users`
(
    `id`         int(11)      NOT NULL,
    `name`       varchar(255) NOT NULL,
    `email`      varchar(255) NOT NULL,
    `uuid`       varchar(255) DEFAULT NULL,
    `username`   varchar(255) DEFAULT NULL,
    `password`   varchar(100) NOT NULL,
    `country_id` int(11)      DEFAULT NULL,
    `street`     varchar(255) DEFAULT NULL,
    `zip`        varchar(255) DEFAULT NULL,
    `city`       varchar(255) DEFAULT NULL,
    `vat`        varchar(255) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='Customer table';



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `countries`
--

CREATE TABLE `countries`
(
    `id`               int(11)      NOT NULL,
    `name`             varchar(255) NOT NULL,
    `country_short`    varchar(2)   NOT NULL,
    `continent`        varchar(255) NOT NULL,
    `capital`          varchar(255) NOT NULL,
    `telephone_prefix` varchar(8)   NOT NULL,
    `tax_percent`      varchar(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='Country table';


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `charge_logs`
--

CREATE TABLE `charge_logs`
(
    `id`          int(11) NOT NULL,
    `cp_id`       int(11) NOT NULL,
    `invoiced`    bit(1)  NOT NULL,
    `uuid`        varchar(255) DEFAULT NULL,
    `start`       datetime     DEFAULT NULL,
    `end`         datetime     DEFAULT NULL,
    `updated_at`  datetime     DEFAULT NULL,
    `created_at`  datetime     DEFAULT NULL,
    `consumption` bigint(13)   DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='Charge log table';



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `errors`
--
CREATE TABLE `errors`
(
    `id`       int(11) NOT NULL,
    `code`     varchar(255) DEFAULT NULL COMMENT 'Short Description of the error',
    `info`     varchar(255) DEFAULT NULL,
    `cp_id`    int(11) NOT NULL,
    `occurred` datetime     DEFAULT NULL,
    `solved`   datetime     DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='error table';

--
-- Indizes für die Tabelle `cps`
--
ALTER TABLE `cps`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_cp_user_id` (`user_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_country_id` (`country_id`);

--
-- Indizes für die Tabelle `countries`
--
ALTER TABLE `countries`
    ADD PRIMARY KEY (`id`);


--
-- Indizes für die Tabelle `charge_logs`
--
ALTER TABLE `charge_logs`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_cp_id` (`cp_id`);


--
-- Indizes für die Tabelle `errors`
--
ALTER TABLE `errors`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_cp_id` (`cp_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `cps`
--
ALTER TABLE `cps`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT für Tabelle `countries`
--
ALTER TABLE `countries`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT für Tabelle `charge_logs`
--
ALTER TABLE `charge_logs`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT für Tabelle `errors`
--
ALTER TABLE `errors`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `cps`
--
ALTER TABLE `cps`
    ADD CONSTRAINT `fk_cp_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
    ADD CONSTRAINT `fk_country_id` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);
COMMIT;

--
-- Constraints der Tabelle `charge_logs`
--
ALTER TABLE `charge_logs`
    ADD CONSTRAINT `fk_cp_id` FOREIGN KEY (`cp_id`) REFERENCES `cps` (`id`);
COMMIT;

--
-- Constraints der Tabelle `errors`
--
ALTER TABLE `errors`
    ADD CONSTRAINT `fk_error_cp_id` FOREIGN KEY (`cp_id`) REFERENCES `cps` (`id`);
COMMIT;


/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
