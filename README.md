# Использование Performance Toolkit’s для анализа производительности

## Цели
* Научиться наполнять Magento тестовыми данными​
* Поиск "проблемных" мест​ с помощью  JMeter
* Анализ полученных результатов​
* Профилирование кода для поиска проблем​
* Устранение проблем и проверка результата​
* Научиться писать сценарии

## Требования

* Docker https://docs.docker.com/engine/installation/ 
* Docker Compose https://docs.docker.com/compose/install/
* JVM 8 http://www.oracle.com/technetwork/java/javase/downloads/jre8-downloads-2133155.html
* JMeter 3.1 https://archive.apache.org/dist/jmeter/binaries/

## Шаги

1) запускаем докер
```docker-compose up -d```

    1.1) для просмора логов запущенного контейнера: ```docker-compose logs```

2) устаналиваем Magento 
```docker-compose exec app install_magento.sh```

3) открываем сайт в браузере http://localhost:8085/

4) запускаем генерацию  профайла
  ```docker-compose exec app php bin/magento setup:performance:generate-fixtures setup/performance-toolkit/profiles/ce/small.xml```

5) запускаем JMeter
  ```bash
    unzip -d steps/jmeter/ steps/jmeter/jmeter.zip
    # Mac/Linux:
        steps/jmeter/bin/jmeter.sh -t steps/jmeter/add_to_cart.jmx
    # Win:
        steps/jmeter/bin/jmeter.bat -t steps/jmeter/add_to_cart.jmx
  ```

6) включаем профилировщик
   ```docker-compose exec app enable_profiler.sh```

   открываем http://localhost:8088/

6.1) Исправляем проблему:
  ```docker-compose exec app bash```
  ```vim app/code/Magento/Checkout/Model/Cart.php```
  Нажимаем ":" и ищем "проблемный" метод "/" + "n addProd" + Enter

7) включаем tideways span-api
   ```docker-compose exec app enable_spans.sh```

   открываем http://localhost:8085/
   
   
# Vagrantfile

Используйте Vagrantfile **только для Windows** когда у вас **уже есть** установленный Vagrant и не получается установить Docker  
Предустановка:
* vagrant up
* vagrant ssh
* cd magento2
