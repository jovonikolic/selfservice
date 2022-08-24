
CREATE TABLE `cps` (
  `id` int(11) NOT NULL,
  `label` varchar(45) DEFAULT NULL COMMENT 'Name of cp',
  `mandant_id` int(11) DEFAULT NULL,  
  `country_id` int(11) DEFAULT NULL,  
  `active` bit(1) DEFAULT NULL,
  `public_display_name`varchar(45) DEFAULT NULL,
  `geo_long` varchar(45) DEFAULT NULL,
  `geo_lat` varchar(45) DEFAULT NULL,
  `street` varchar(45) DEFAULT NULL,
  `zip` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `serialnumber` varchar(45) DEFAULT NULL,
  `firmwareversion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='charge point table';


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mandants`
--

CREATE TABLE `mandants` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `uuid` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `country_id` int(11) DEFAULT NULL,  
  `street` varchar(45) DEFAULT NULL,
  `zip` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `vat` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Customer table';



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country_short` varchar(2) NOT NULL,
  `continent` varchar(45) NOT NULL,
  `capital` varchar(45) NOT NULL,
  `telephone_prefix` varchar(8) NOT NULL,
  `tax_percent` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Country table';


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `charge_logs`
--

CREATE TABLE `charge_logs` (
  `id` int(11) NOT NULL,
  `cp_id` int(11) NOT NULL,
  `mandant_id` int(11) NOT NULL,
  `invoiced` bit(1) NOT NULL,
  `uuid` varchar(45) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `kwh_start` bigint(13) DEFAULT NULL,
  `kwh_end` bigint(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Charge log table';

--
-- Indizes für die Tabelle `cps`
--
ALTER TABLE `cps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cp_mandant_id` (`mandant_id`);

--
-- Indizes für die Tabelle `mandants`
--
ALTER TABLE `mandants`
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
  ADD KEY `fk_mandant_id` (`mandant_id`),
  ADD KEY `fk_cp_id` (`cp_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `cps`
--
ALTER TABLE `cps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `mandants`
--
ALTER TABLE `mandants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `charge_logs`
--
ALTER TABLE `charge_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `cps`
--
ALTER TABLE `cps`
  ADD CONSTRAINT `fk_cp_mandant_id` FOREIGN KEY (`mandant_id`) REFERENCES `mandants` (`id`);
COMMIT;

--
-- Constraints der Tabelle `mandants`
--
ALTER TABLE `mandants`
  ADD CONSTRAINT `fk_country_id` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);
COMMIT;

--
-- Constraints der Tabelle `charge_logs`
--
ALTER TABLE `charge_logs`
  ADD CONSTRAINT `fk_mandant_id` FOREIGN KEY (`mandant_id`) REFERENCES `mandants` (`id`),
  ADD CONSTRAINT `fk_cp_id` FOREIGN KEY (`cp_id`) REFERENCES `cps` (`id`);
COMMIT;


/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
