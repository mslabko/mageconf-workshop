# Использование Performance Toolkit’s для анализа производительности

## Цели
* Научиться наполнять Magento тестовыми данными​
* Поиск "проблемных" мест​ с помощью  JMeter
* Анализ полученных результатов​
* Профилирование кода для поиска проблемы​
* Устренение проблем и проверка результата​
* Научиться писать сценарии

## Требования

* Docker https://docs.docker.com/engine/installation/ 
* Docker Compose https://docs.docker.com/compose/install/
* JVM 8 http://www.oracle.com/technetwork/java/javase/downloads/jre8-downloads-2133155.html
* JMeter 3.1 https://archive.apache.org/dist/jmeter/binaries/

## Шаги

1) запускаем докер
```docker-compose up```

2) открываем сайт в браузере http://localhost:8085/

3) запускаем генерацию  профайла
  ```docker-compose exec app php bin/magento setup:performance:generate-fixtures setup/performance-toolkit/profiles/ce/small.xml```

4) запускаем JMeter
  ```bash
    unzip -d steps/jmeter/ steps/jmeter/jmeter.zip
    # Mac/Linux:
        steps/jmeter/bin/jmeter.sh -t steps/jmeter/add_to_cart.jmx
    # Win:
        steps/jmeter/bin/jmeter.bat -t steps/jmeter/add_to_cart.jmx
  ```

5) включаем профилировщик
   ```docker-compose exec app enable_profiler.sh```

   открываем http://localhost:8088/

6) включаем tideways span-api
   ```docker-compose exec app enable_spans.sh```

   открываем http://localhost:8085/