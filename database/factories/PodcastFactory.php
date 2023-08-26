<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PodcastFactory extends Factory
{
    public static $titleEducation = array(
        "Learning Odyssey: Exploring New Horizons",
        "Student Success Stories: From Struggle to Triumph",
        "Teachers' Lounge: Insights into Education",
        "Study Smarter Not Harder",
        "Global Classroom: Cross-Cultural Learning",
        "EduChat: Debating Education Trends",
        "Beyond Books: Practical Learning Tips",
        "History Uncovered: Unraveling the Past",
        "Education Innovators: Redefining Learning",
        "Mindful Learning: Techniques for Focus"
    );
    public static $titleTechnology = array(
        "CodeCraft: Crafting Digital Solutions",
        "Tech Titans: Interviews with Industry Leaders",
        "Future Tech Trends: Navigating the Digital Frontier",
        "Bits & Brews: Conversations on Code",
        "Gadget Geeks Unite",
        "Cybersecurity Chronicles: Defending the Digital Realm",
        "Tech Explorers: Journey through Innovations",
        "AI Unleashed: Artificial Intelligence Insights",
        "Byte-sized Breakthroughs: Tech News Digest",
        "VR Uncovered: Virtual Reality Insights"
    );
    public static $titleArts = array(
        "Artistry in Motion: Creative Expressions",
        "Cultural Conversations: Bridging Differences",
        "Literary Whispers: Exploring Written Worlds",
        "Tales & Traditions: Folklore and Storytelling",
        "Canvas Chronicles: Art and Its Impact",
        "Melodies & Memories: Music's Influence",
        "Cinephile Chat: Cinema Appreciation",
        "Cultural Fusion: Blending Traditions",
        "Design Dialogues: Aesthetic Discourse",
        "Theatre Spotlight: Behind the Curtains"
    );
    public static $titleScience = array(
        "Scientific Frontiers: Discoveries Beyond Limits",
        "Research Roundup: Recent Findings",
        "Inquiry Insight: Curiosity Unleashed",
        "Exploring Earth: Geology and Beyond",
        "Cosmic Wonders: Astronomy Adventures",
        "BioBytes: Biology Breakthroughs",
        "Chemistry Chronicles: Elements Unveiled",
        "Ecology Echoes: Ecosystem Explorations",
        "Mind & Matter: Neuroscientific Endeavors",
        "Physics Phacts: Unraveling the Universe",
    );
    public static $titleSports = array(
        "Athlete's Journey: From Training to Triumph",
        "Game Plan: Strategy Sessions",
        "Sporting Legends: Interviews with Icons",
        "Fitness Focus: Health and Performance",
        "Victory Vibes: Celebrating Wins",
        "Beyond the Arena: Athlete Life Off-Field",
        "Sports Science Insights: Training Techniques",
        "Fanatics Unite: Passionate Sports Talk",
        "In the Zone: Mental Preparation",
        "Sports Stories: Personal Triumphs"
    );
    public static $titleHealth = array(
        "Wellness Wisdom: Mind-Body Harmony",
        "Holistic Health: Wholeness in Well-being",
        "Nutrition Notes: Navigating Diets",
        "Mental Health Matters: Break the Stigma",
        "Fitness Fundamentals: Move to Improve",
        "Wellness Wanderlust: Healing Journeys",
        "Soulful Living: Spirituality and Health",
        "Mindful Moments: Meditation and Mindfulness",
        "Sleep Soundly: Exploring Rest",
        "Healing Hands: Alternative Therapies",
    );
    public static $titleStudent = array(
        "Campus Chronicles: Student Stories",
        "Beyond the Books: Extracurricular Explorations",
        "Dorm Diaries: Navigating Dorm Life",
        "Social Sphere: Networking and Friendships",
        "Student Leadership Spotlight",
        "Academic Adventures: Learning Beyond Lectures",
        "Culture Clash: Diverse Perspectives",
        "Student Entrepreneurs: Building Businesses",
        "Squad Goals: Building Supportive Communities",
        "Freshman Fables: Navigating New Beginnings",
    );
    public static $titleCareer = array(
        "Career Compass: Navigating Professional Paths",
        "Interview Insights: Acing Job Interviews",
        "Rising Stars: Success Stories",
        "Networking Nuggets: Building Connections",
        "Leadership Lessons: From Managers to Mentors",
        "Side Hustle Chronicles: Balancing Passion and Paycheck",
        "Entrepreneurial Edge: Startup Stories",
        "Job Search Strategies: From Listings to Offers",
        "Professional Growth Hacks: Skills and Strategies",
        "Industry Insight: Trends and Opportunities",
    );
    public static $titlePersonal = array(
        "Self-Discovery Quest: Navigating Identity",
        "Mindset Makeover: Positive Thinking Techniques",
        "Goal Getter: Setting and Achieving Dreams",
        "Life's Lessons: Wisdom from Experience",
        "Confidence Chronicles: Building Self-Esteem",
        "Time Mastery: Productivity and Prioritization",
        "Happiness Habits: Cultivating Joy",
        "Emotional Intelligence Explorations",
        "Relationship Resonance: Connection and Communication",
        "Life Hacks Unleashed: Practical Tips for Success",
    );
    public static $titleEntertainment = array(
        "Pop Culture Ponderings: Media and More",
        "Silver Screen Stories: Film Fanatics Unite",
        "Chart-Topping Tunes: Music Reviews and Reflections",
        "Binge-Worthy: TV Show Discussions",
        "Page Turner Talks: Book Club Conversations",
        "Gaming Galore: Video Game Insights",
        "Laugh Out Loud: Comedy Corner",
        "Celeb Chats: Interviews with Entertainers",
        "Behind the Scenes: Industry Insider Scoop",
        "Arts & Amusements: Creativity and Enjoyment",
    );
    public static function getTitles(){
        $allTitles = array(
            "Education" => self::$titleEducation,
            "Technology" => self::$titleTechnology,
            "Arts and Culture" => self::$titleArts,
            "Science and Research" => self::$titleScience,
            "Sports and Athletics" => self::$titleSports,
            "Health and Wellness" => self::$titleHealth,
            "Student Life" => self::$titleStudent,
            "Career and Professional Development" => self::$titleCareer,
            "Personal Development" => self::$titlePersonal,
            "Entertainment" => self::$titleEntertainment,
        );
        return $allTitles;
    }
    public function getRandomPath(){
        //return random path from a list
        $pathList = array(
            "storage/podpic0.png",
            "storage/podpic1.png",
            "storage/podpic2.avif",
            "storage/podpic3.jpg",
            "storage/podpic4.jpg",
            "storage/podpic5.jpg",
            "storage/podpic6.jpg",
            "storage/podpic7.jpg",
            "storage/podpic8.png",
            "storage/podpic9.jpg",
            "storage/podpic10.jpg",
            "storage/podpic11.jpg",
            "storage/podpic12.png",
            "storage/podpic13.jpg",
            "storage/podpic14.png",
        );
        return $pathList[fake()->numberBetween(0, 14)];
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'image_url' => self::getRandomPath(),
            'description' => fake()->realText(100),
            'creator_id' => fake()->numberBetween(1, 10),
            'category_id' => fake()->numberBetween(1, 10),
        ];
    }
}
