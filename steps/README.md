# Использование Performance Toolkit’s для анализа производительности

## Цели
* Научиться наполнять Magento тестовыми данными​
* Поиск "проблемных" мест​ с помощью  JMeter
* Анализ полученных результатов​
* Профилирование кода для поиска проблемы​
* Устренение проблем и проверка результата​
* Tideways span-API - профилируем в продакшене​
* Научиться писать сценарии

## Требования

* https://docs.docker.com/engine/installation/ - Docker
* https://docs.docker.com/compose/install/ - Docker Compose
* http://www.oracle.com/technetwork/java/javase/downloads/jre8-downloads-2133155.html JVM 8 (только для JMeter)

## Шаги

1) запускаем докер
```docker-compose up```

2) открываем сайт в браузере  
```http://localhost:8085/```

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
   ```docker-compose exec magento enable_profiler.sh```
   ```http://localhost:8088/```

6) включаем tideways span-api
   ```docker-compose exec magento enable_spans.sh```
   ```http://localhost:8085/```

Troubleshoots

1) no mongo indexes
docker-compose exec xhgui php /tmp/mongo.php