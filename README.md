# Image Optimization Bundle ( minify - tinyjpg.com)
### Bundle for Symfony 2/3

Main idea is to use tinify API to shrink images, that are already stored in server. Shrinking  when uploading images takes too much time, so it's better to do that with commands  firedup in cron 



[![SensioLabsInsight](https://insight.sensiolabs.com/projects/689cbe3f-bc20-4d50-a00c-019e151cb6aa/big.png)](https://insight.sensiolabs.com/projects/689cbe3f-bc20-4d50-a00c-019e151cb6aa)



# Usage

Bundle adds **new commands**  (for use with cron for example):

`console image:optim:scan`  - searches for images in given dirs

`console image:optim:minify` - minify images (default is 20 images per 1 run - can be overwriten by argument)

`console image:optim:stats` - writes statistics  info 

`console image:optim:truncate` - removes all images data from database

# Installation

Install with composer 

` composer require poznet/imageoptimbundle `


create databes structures 

```
console d:s:u --force
```


**Add API key in parameters.yml**

```
tinifyAPI: key
```



**Define paths in parameters.yml**
All paths should be realive to main all dir (1 above app).

This parameters are used in Finder() Component as in() and exclude()


```
imageoptim_dirs:
  - web/media
  - web/media2
imageoptim_excluded:
  - cache

```

# Other

Bundle  uses custom events  , so it can be easily extended

Events :
- image.add
- image.minify

Both takes Poznet\ImageOptimBundle\Event\ImageEvent class as event.



