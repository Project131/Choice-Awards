package choiceawards.api;

import java.util.Arrays;

import org.springframework.boot.CommandLineRunner;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.ApplicationContext;
import org.springframework.context.annotation.Bean;


import java.util.*;
import org.springframework.web.bind.annotation.RequestMapping;  

@SpringBootApplication
public class ApiApplication {

	public static void main(String[] args) {
		SpringApplication.run(ApiApplication.class, args);
	}

	@Bean
	public CommandLineRunner commandLineRunner(ApplicationContext ctx) {
		return args -> {
					
			System.out.println("Let's inspect the beans provided by Spring Boot:");

		/*	String[] beanNames = ctx.getBeanDefinitionNames();
			Arrays.sort(beanNames);
			for (String beanName : beanNames) {
				System.out.println(beanName);
			}
			*/
			

		};
	}
	//how to pass path paramteter in url in spring rest
	@RequestMapping(method = RequestMethod.GET, value = "/custom")
    public String controllerMethod(@RequestParam Map<String, String> customQuery) {

        System.out.println("customQuery = brand " + customQuery.containsKey("brand"));
        System.out.println("customQuery = limit " + customQuery.containsKey("limit"));
        System.out.println("customQuery = price " + customQuery.containsKey("price"));
        System.out.println("customQuery = other " + customQuery.containsKey("other"));
        System.out.println("customQuery = sort " + customQuery.containsKey("sort"));

        return customQuery.toString();
    }
	//calling query:
	@Query(value="SELECT *FROM movies WHERE categories=?bestpicture". nativeQuery=true);
	List<Movie> getMovieByCategory(String category);
	public List<Movie> getMovieByCategory(String category){
		List <Movie> catList = //query DB
		catList.forEach(System.out::println);
	}
	//get url like this, test
	@GetMapping(path = {"/user", "/user/{data}"})
	public void user(@PathVariable(required=false,name="data") String data, @RequestParam(required=false) Map<String,String> qparams) {
		qparams.forEach((a,b) -> {
			System.out.println(String.format("%s -> %s",a,b));
		};
	
		if (data != null) {
			System.out.println(data);
		}
		
	};
	

}
